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

class ClientAuthController extends Controller
{
    use Helpers;

    /**
     * Client sign up
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function signup(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required',
            'email'        => 'required|email|unique:clients',
            'password'     => 'required|min:5|confirmed',
        ]);

        $client_data = $request->only(['email', 'name', 'password']);
        $client_data['confirmation_code'] = str_random();
        $client = Client::create($client_data);

        // TODO: Do this async?
        Mail::send('Emails.ClientConfirmEmail',
            ['name' => $client->name, 'confirmation_code' => $client->confirmation_code],
            function ($message) use ($request) {
                $message->to($request->get('email'), $request->get('name'))
                    ->subject('Thank you for registering for Vitee');
            });

        session()->flash('message', 'Success! You can now login.');

        return $this->response->created();


    }

    /**
     * Confirm a client email
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

        session()->flash('message', 'Success! Your email is now verified. You can now login.');


        return $this->response()->array(['message'=> 'Your Email Confirmed, You can now login!']);
        return redirect()->route('login');
    }

    /**
     * Client login
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
//                return $this->response->errorUnauthorized();
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