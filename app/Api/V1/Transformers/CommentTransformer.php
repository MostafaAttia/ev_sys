<?php

namespace App\Api\V1\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Client;
use App\Models\Event;
use App\Models\Comment;

class CommentTransformer extends TransformerAbstract
{
    public function transform(Comment $comment)
    {

        $event = Event::findOrFail($comment->event_id);
        $client = Client::findOrFail($comment->client_id);


        $comment = [
            'comment_id'    => $comment->id,
            'content'       => $comment->content,
            'event'         => [
                'event_id'      => $event->id,
                'title'         => $event->title,
                'description'   => $event->description
            ],
            'user'         => [
                'user_id'       => $client->id,
                'name'          => $client->first_name . ' ' . $client->last_name ,
                'image'         => $client->image_path
            ],
            'created_at'       => $comment->created_at,
            'updated_at'       => $comment->updated_at,
        ];

        return $comment;
    }
}