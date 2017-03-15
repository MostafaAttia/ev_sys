<?php

namespace App\Api\V1\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        $this->validate($request, [
            'first_name'    => 'required|max:56',
            'last_name'     => 'required|max:56',
            'email'         => 'required|email|unique:clients',
            'password'      => 'required|min:6|confirmed',
            'gender'        => 'in:male,female',
            'dob'           => 'date',
            'phone'         => 'max:15|min:4',
            'address'       => 'string|min:10|max:255',
            'image'         => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $client_data = $request->all();
        $client_data['confirmation_code'] = str_random();

        // upload user image

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $image = $request->file('image');
        $t = Storage::disk('s3')->put('user_content/'.$imageName, file_get_contents($image), 'public');
        $imageName = Storage::disk('s3')->url('user_content/'.$imageName);
        $client_data['image_path'] = $imageName;

        $client = Client::create($client_data);

        // TODO: Do this async?
        Mail::send('Emails.ClientConfirmEmail',
            ['first_name' => $client->first_name, 'confirmation_code' => $client->confirmation_code],
            function ($message) use ($request) {
                $message->to($request->get('email'), $request->get('first_name'))
                    ->subject('Thank you for registering for Vitee');
        });

        Config::set('auth.providers.users.model', Client::class);
        $credentials = $request->only(['email', 'password']);

        try {
            if (! $token = JWTAuth::attempt($credentials) ) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return $this->response->error('could_not_create_token', 500);
        }

        return $this->response->array([
            'message'   => 'Thank you for registering for Vitee!',
            'token'     => $token
        ]);

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
            return view('Public.Errors.Generic', [
                'message' => 'The confirmation code is missing or malformed.',
            ]);
        }

        $client->is_email_confirmed = 1;
        $client->confirmation_code = null;
        $client->save();

        return $this->response()->array(['message'=> 'Your Email Confirmed, You can now login!']);

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

        $client = Client::where('email', $request->get('email'))->first();
        if($client){
            if(! $client->is_email_confirmed) {
                return 'You Are Not Confirmed yet';
            }
        }

        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        try {
            if (! $token = JWTAuth::attempt($credentials) ) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return $this->response->error('could_not_create_token', 500);
        }


        return response()->json(compact('token'));
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