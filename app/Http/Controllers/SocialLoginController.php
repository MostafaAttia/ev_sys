<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use Config;

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
    }

}