<?php

namespace App\Http\Controllers;

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
        if($provider == 'facebook'){
            return Socialite::driver($provider)->fields([
                'name', 'email', 'gender', 'birthday'
            ])->scopes([
                'email', 'user_birthday'
            ])->redirect();
        }

        if($provider == 'google'){
            return Socialite::driver($provider)->scopes([
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile',
                'https://www.googleapis.com/auth/plus.login'
            ])->redirect();
        }

    }

    public function handleProviderCallback($provider)
    {
        Config::set('auth.providers.users.model', Client::class);
        $user = Socialite::driver($provider)->user();

        $data = [
            'name'                  => $user->getName(),
            'email'                 => $user->getEmail(),
            'image_path'            => $user->getAvatar(),
            'gender'                => isset($user->user['gender']) ? $user->user['gender'] : '',
            'is_email_confirmed'    => 1

        ];

        $client = Client::firstOrCreate($data);

        try {

            if (! $token = JWTAuth::fromUser($client) ) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return $this->response->error('could_not_create_token', 500);
        }

        return response()->json(compact('token'));

    }

}