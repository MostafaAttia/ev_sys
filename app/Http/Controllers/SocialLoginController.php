<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Validator;
use JWTAuth;
use Config;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\Client;

class SocialLoginController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();

    }

    public function handleProviderCallback(SocialAccountService $service, $provider)
    {
        $user = $service->createOrGetUser(Socialite::driver($provider), $provider);

        Auth::guard('client')->login($user);
        return redirect()->to('/home#');




//        $user = Socialite::driver($provider)->user();

//        $username = explode(" ", $user->getName());
//
//        $first_name = $username[0];
//        $last_name = $username[1];
//
//        $data = [
//            'first_name'            => $first_name,
//            'last_name'             => $last_name,
//            'email'                 => $user->getEmail(),
//            'image_path'            => $user->getAvatar(),
//            'gender'                => isset($user->user['gender']) ? $user->user['gender'] : '',
//            'is_email_confirmed'    => 1
//
//        ];
//
//        $validator = Validator::make($data, [
//            'first_name'    => 'required|max:56',
//            'email'         => 'required|email|unique:clients',
//        ]);
//
//        if($validator->fails()) {
//            throw new ValidationHttpException($validator->errors()->all());
//        }
//
//        $client = Client::firstOrCreate($data);
//
//        try {
//
//            if (! $token = JWTAuth::fromUser($client) ) {
//                return response()->json(['error' => 'invalid_credentials'], 401);
//            }
//        } catch (JWTException $e) {
//            return $this->response->error('could_not_create_token', 500);
//        }
//
//        return response()->json(compact('token'));

    }

}