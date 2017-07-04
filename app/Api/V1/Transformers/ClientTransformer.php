<?php

namespace App\Api\V1\Transformers;

use Illuminate\Support\Facades\Storage;
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
            'image_path'                => $client->image_path ? [
                'original'              => config('attendize.s3_base_url').config('attendize.s3_client_original'). $client->image_path,
                '60*60'                 => config('attendize.s3_base_url').config('attendize.s3_client_60_60'). $client->image_path,
                '120*120'               => config('attendize.s3_base_url').config('attendize.s3_client_120_120'). $client->image_path,
                '240*240'               => config('attendize.s3_base_url').config('attendize.s3_client_240_240'). $client->image_path,
            ] : [
                'original'              => config('attendize.s3_base_url').config('attendize.s3_client_defaults'). 'original.jpg',
                '60*60'                 => config('attendize.s3_base_url').config('attendize.s3_client_defaults'). '60*60.jpg',
                '120*120'               => config('attendize.s3_base_url').config('attendize.s3_client_defaults'). '120*120.jpg',
                '240*240'               => config('attendize.s3_base_url').config('attendize.s3_client_defaults'). '240*240.jpg',
            ],
            'is_email_confirmed'        => $client->is_email_confirmed,
        ];

        return $client;
    }
}