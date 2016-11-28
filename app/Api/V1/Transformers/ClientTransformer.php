<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Client;

class ClientTransformer extends TransformerAbstract
{
    public function transform(Client $client)
    {

        $client = [
            'id'                        => $client->id,
            'first_name'                => $client->first_name,
            'last_name'                 => $client->last_name,
            'email'                     => $client->email,
            'gender'                    => $client->gender,
            'dob'                       => $client->dob,
            'phone'                     => $client->phone,
            'address'                   => $client->address,
            'image_path'                => $client->image_path,
            'is_email_confirmed'        => $client->is_email_confirmed,
        ];

        return $client;
    }
}