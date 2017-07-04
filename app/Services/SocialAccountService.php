<?php
/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 15/06/17
 * Time: 10:57 م
 */

namespace App\Services;

use App\Models\Client;
use Config;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Log;
//use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{
    public function createOrGetUser(Provider $provider)
    {

        Config::set('auth.providers.users.model', Client::class);

        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        $avatar_original = $providerUser->avatar_original;

        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        $username = explode(" ", $providerUser->getName());

        $first_name = $username[0];
        $last_name = $username[1];

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = Client::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = Client::create([
                    'first_name'            => $first_name,
                    'last_name'             => $last_name,
                    'email'                 => $providerUser->getEmail(),
                    'password'              => bcrypt(str_random()),
                    'image_path'            => $providerUser->getAvatar('avatar_original'),
                    'is_email_confirmed'    => 1
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}