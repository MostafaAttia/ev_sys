<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Organiser;

class OrganiserTransformer extends TransformerAbstract
{
    public function transform(Organiser $organiser)
    {

        $organiser = [
            'id'                        => $organiser->id,
            'account_id'                => $organiser->account_id,
            'name'                      => $organiser->name,
            'email'                     => $organiser->email,
            'about'                     => $organiser->about,
            'phone'                     => $organiser->phone,
            'facebook'                  => $organiser->facebook,
            'twitter'                   => $organiser->twitter,
            'image_path'                => $organiser->logo_path ? [
                'original'              => config('attendize.s3_base_url').config('attendize.s3_organiser_original'). $organiser->logo_path,
                '60*60'                 => config('attendize.s3_base_url').config('attendize.s3_organiser_60_60'). $organiser->logo_path,
                '120*120'               => config('attendize.s3_base_url').config('attendize.s3_organiser_120_120'). $organiser->logo_path,
                '240*240'               => config('attendize.s3_base_url').config('attendize.s3_organiser_240_240'). $organiser->logo_path,
            ] : [
                'original'              => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). 'original.jpg',
                '60*60'                 => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). '60*60.jpg',
                '120*120'               => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). '120*120.jpg',
                '240*240'               => config('attendize.s3_base_url').config('attendize.s3_organiser_defaults'). '240*240.jpg',
            ]
        ];

        return $organiser;
    }
}