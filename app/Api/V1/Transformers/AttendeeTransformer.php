<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Attendee;

class AttendeeTransformer extends TransformerAbstract
{
    public function transform(Attendee $attendee)
    {

        $attendee = [
            'id'                        => $attendee->id,
            'first_name'                => $attendee->first_name,
            'last_name'                 => $attendee->last_name,
            'email'                     => $attendee->email,
            'ref_no'                    => $attendee->private_reference_number,
            'is_cancelled'              => $attendee->is_cancelled,
            'order_id'                  => $attendee->order_id,
            'event_id'                  => $attendee->event_id,
            'ticket_id'                 => $attendee->ticket_id,
            'account_id'                => $attendee->account_id,

        ];

        return $attendee;
    }
}