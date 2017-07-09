<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Auth\Passwords\PasswordBroker;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and 
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    
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
     * Generates reset token for a given user 
     *
     * * <strong>Parameters:</strong>
     * <br>
     * email                : required|email <br>
     *
     * NOTE: in headers please send  Accept  application/json , or your request will fail :)
     *
     * <strong>Response:</strong> <br>
     * 
     * success: data array with password-reset token, <br>
     * error: otherwise <br>
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getResetToken(Request $request)
    {

        $validator = \Validator::make($request->all(), ['email' => 'required|email']);

        if($validator->fails()){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors(),
                ], 404);
        }

        if ($request->wantsJson()) {

            $client = Client::where('email', $request->input('email'))->first();

            if (!$client) {
                return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'invalid credentials / user not found',
                ], 404);
            }
            $token = $this->passwords->createToken($client);
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => ['token' => $token],
                    'message'   => null,
                ], 200);
        }

        return response()->json(
            [
                'status'    => 'error',
                'data'      => null,
                'message'   => 'you have to send Accept header as application/json',
            ], 404);


    }
}