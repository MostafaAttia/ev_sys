<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
// use App\Transformers\Json;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Models\Client;

use Illuminate\Auth\Passwords\PasswordBroker;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * The password broker implementation.
     *
     * @var PasswordBroker
     */
    protected $passwords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PasswordBroker $passwords)
    {
        $this->passwords = $passwords;
        $this->middleware('guest');
    }

    /**
     * Reset the given user's password.
     *
     * 
     * <strong>Parameters:</strong>
     * <br>
     * email                : required|email <br>
     * password             : required|min:6 <br>
     * password_confirmation: required <br>
     * token                : required <br>
     *
     * NOTE: in headers please send  Accept  application/json , or your request will fail :)
     *
     * <strong>Response:</strong> <br>
     * 
     * array containing a message with a login token, <br>
     * if success -> token:{your_login_token}, <br>
     * if failed ->  token:null <br>
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {

        $validator = \Validator::make($request->all(), 
                    [
                        'email'     => 'required|email',
                        'password'  => 'required|confirmed',
                        'token'     => 'required'
                    ]
        );

        if($validator->fails()){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors(),
                ], 404);
        }

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $client = Client::where('email', $request->input('email'))->first();

        if($this->passwords->tokenExists($client, $request->get('token')) && $request->wantsJson()) {

            $client->password = $request->get('password');
            $client->save();

            $token = \JWTAuth::fromUser($client);
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => ['token' => $token],
                    'message'   => null,
                ], 200);
        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'token is not exist || you have to submit a json request',
                ], 404);
        }

    }
}