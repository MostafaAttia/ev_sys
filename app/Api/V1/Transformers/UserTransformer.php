<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {

        $roles = $user->roles;

//        $perms = $roles->perms();
//        $user = User::with('roles.perms')->get();
//        return $user;

        return [
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $roles,
            'added' => date('Y-m-d', strtotime($user->created_at))
        ];
    }
}