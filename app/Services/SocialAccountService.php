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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
                $imageName = 'img_'.md5(time(). str_random()).'.jpg';

                $image_original = Image::make($avatar_original)->stream();
                Storage::disk('s3')->put('user_content/original/'.$imageName, $image_original->__toString(), 'public');

                // save as THUMB 60*60
                $image_thumb_60_60 = Image::make($avatar_original)->resize(60, 60)->stream();
                Storage::disk('s3')->put('user_content/60*60/'.$imageName, $image_thumb_60_60->__toString(), 'public');

                // save as THUMB 120*120
                $image_thumb_120_120 = Image::make($avatar_original)->resize(120, 120)->stream();
                Storage::disk('s3')->put('user_content/120*120/'.$imageName, $image_thumb_120_120->__toString(), 'public');

                // save as VERTICAL poster 240*240
                $image_vert_poster_240_240 = Image::make($avatar_original)->resize(240, 240)->stream();
                Storage::disk('s3')->put('user_content/240*240/'.$imageName, $image_vert_poster_240_240->__toString(), 'public');

                $user = Client::create([
                    'first_name'            => $first_name,
                    'last_name'             => $last_name,
                    'email'                 => $providerUser->getEmail(),
                    'password'              => bcrypt(str_random()),
                    'image_path'            => $imageName,
                    'is_email_confirmed'    => 1
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}