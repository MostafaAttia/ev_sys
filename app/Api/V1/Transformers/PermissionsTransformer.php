<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Permission;

class PermissionsTransformer extends TransformerAbstract
{
    public function transform(Permission $perm)
    {
        return [
            'name'          => $perm->name,
            'display_name'  => $perm->display_name,
            'description'   => $perm->description,
            'added'         => date('Y-m-d', strtotime($perm->created_at))
        ];
    }
}