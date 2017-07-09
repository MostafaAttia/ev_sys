<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\ClientTransformer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use JWTAuth;
use Validator;
use Config;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\ValidationHttpException;
use Storage;
use Auth;
use League\Fractal;

class ClientAuthController extends Controller
{
    use Helpers;

    /**
     * Sign Up
     *
     * <strong>Parameters:</strong>
     * <br>
     * first_name           : required <br>
     * last_name            : required <br>
     * email                : required|email|unique <br>
     * password             : required|min:6 <br>
     * password_confirmation: required <br>
     * <br>
     * gender               : optional|in:male,female <br>
     * dob                  : optional|date <br>
     * phone                : optional|max:15|min:4 <br>
     * address              : optional|string|min:10|max:255 <br>
     * image                : optional|image|mimes:jpeg,png,jpg|max:2048 bytes <br>
     *
     * <strong>Response:</strong>
     *
     * array containing a message of success and a token
     *
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required|max:56',
            'last_name'     => 'required|max:56',
            'email'         => 'required|email|unique:clients',
            'password'      => 'required|min:6|confirmed',
            'gender'        => 'in:male,female',
            'dob'           => 'date',
            'phone'         => 'max:15|min:4',
            'address'       => 'string|min:10|max:255',
            'image'         => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=300,min_height=300',
        ]);


        if($validator->fails()) {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors(),
                ], 400);
        }


        $client_data = $request->all();
        $client_data['confirmation_code'] = str_random();

        // upload user image
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = 'img_'.md5(time(). str_random()).'.'.$image->getClientOriginalExtension();
            $client_data['image_path'] = $imageName;

            Storage::disk('s3')->put('user_content/original/'.$imageName, file_get_contents($image), 'public');

            // save as THUMB 60*?
            $image_thumb_60_60 = Image::make($image)->resize(60, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('user_content/60*60/'.$imageName, $image_thumb_60_60->__toString(), 'public');

            // save as THUMB 120*?
            $image_thumb_120_120 = Image::make($image)->resize(120, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('user_content/120*120/'.$imageName, $image_thumb_120_120->__toString(), 'public');

            // save as VERTICAL poster 240*?
            $image_vert_poster_240_240 = Image::make($image)->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('user_content/240*240/'.$imageName, $image_vert_poster_240_240->__toString(), 'public');

        }

        $client = Client::create($client_data);

        // TODO: Do this async?
        Mail::send('Emails.ClientConfirmEmailApi',
            ['first_name' => $client->first_name, 'confirmation_code' => $client->confirmation_code],
            function ($message) use ($request) {
                $message->to($request->get('email'), $request->get('first_name'))
                    ->subject('Thank you for registering for Vitee');
        });

        return response()->json(
            [
                'status'    => 'success',
                'data'      => null,
                'message'   => 'Thank you for registering for Vitee!, We have sent you a confirmation email to '. $client->email,
            ], 201);

    }

    /**
     * Confirm email
     *
     * @param $confirmation_code
     * @return mixed
     */
    public function confirmEmail($confirmation_code)
    {
        $client = Client::whereConfirmationCode($confirmation_code)->first();

        if (!$client) {
            Session::flash('message', [
                'content'   => 'The confirmation code is missing or malformed!',
                'type'      => 'error' // alert, success, error, warning, info
            ]);

            return redirect()->intended('home');
        }

        $client->is_email_confirmed = 1;
        $client->confirmation_code = null;
        $client->save();

        Auth::guard('client')->login($client);

        Session::flash('message', [
            'content'   => 'Welcome!',
            'type'      => 'success' // alert, success, error, warning, info
        ]);

        return redirect()->intended('home');

    }

    /**
     * Login
     *
     * <strong>Parameters:</strong>
     * <br>
     * email                : required|email|unique <br>
     * password             : required|min:6 <br>
     *
     * <strong>Response:</strong>
     * <br>
     * {"token": "jwt_token"}
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string|void
     */
    public function login(Request $request)
    {
        Config::set('auth.providers.users.model', Client::class);
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors(),
                ], 400);
        }

        $client = Client::where('email', $request->get('email'))->first();

        if($client){
            if(! $client->is_email_confirmed) {
                return response()->json(
                    [
                        'status'    => 'error',
                        'data'      => null,
                        'message'   => 'You Are Not Confirmed yet.',
                    ], 404);

            }
        }



        try {
            if (! $token = JWTAuth::attempt($credentials) ) {
                return response()->json(
                    [
                        'status'    => 'error',
                        'data'      => null,
                        'message'   => 'invalid credentials!',
                    ], 400);

            }
        } catch (JWTException $e) {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'could_not_create_token.',
                ], 500);
        }

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $client = new Fractal\Resource\Item($client, new ClientTransformer);
        $client = $fractal->createData($client)->toArray();

        $user['client'] = $client;
        foreach(compact('token') as $key=>$value){
            $user[$key] = $value;
        }


        return response()->json(
            [
                'status'    => 'success',
                'data'      => $user,
                'message'   => null,
            ], 200);
    }



    public function recovery(Request $request)
    {
        $validator = Validator::make($request->only('email'), [
            'email' => 'required'
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject(Config::get('boilerplate.recovery_email_subject'));
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->response->noContent();
            case Password::INVALID_USER:
                return $this->response->errorNotFound();
        }
    }

    public function reset(Request $request)
    {
        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $validator = Validator::make($credentials, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                if(Config::get('boilerplate.reset_token_release')) {
                    return $this->login($request);
                }
                return $this->response->noContent();

            default:
                return $this->response->error('could_not_reset_password', 500);
        }
    }
}