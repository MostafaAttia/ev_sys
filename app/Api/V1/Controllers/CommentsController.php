<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Comment;
use App\Models\Event;
use App\Api\V1\Transformers\CommentTransformer;

use Dingo\Api\Routing\Helpers;

class CommentsController extends Controller
{

    use Helpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created comment in storage.
     *
     * Parameters: <br>
     * content: text|required
     * 
     * Headers : auth token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request, $event_id)
    {
        $validator = \Validator::make($request->only('content'), [
            'content'   => 'required'
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors(),
                ], 404);
        }

        $client = \JWTAuth::parseToken()->toUser();
        $event = Event::find($event_id);
        if($event == null){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'event not found',
                ], 404);
        }

        if(!$event->canComment){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'you can not comment to this event',
                ], 404);
        }

        $comment_data['content'] = $request->get('content');
        $comment_data['event_id'] = $event_id;
        $comment_data['client_id'] = $client->id;

        $comment = Comment::create($comment_data);

        return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'comment created successfully',
                ], 200);

    }

    /**
     * return the specified comment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getComment($id)
    {
        $comment = Comment::find($id);
        if($comment == null){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'comment not found',
                ], 404);
        }

        return response()->json(
                [
                    'status'    => 'success',
                    'data'      => $comment,
                    'message'   => null,
                ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified comment in storage.
     *
     * Parameters: <br>
     * content: text|required
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateComment(Request $request, $comment_id)
    {

        $validator = \Validator::make($request->only('content'), [
            'content'   => 'required'
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors(),
                ], 404);
        }

        $comment = Comment::find($comment_id);
        $client = \JWTAuth::parseToken()->toUser();

        if($comment == null){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'comment not found',
                ], 404);
        }

        if($comment->client_id !== $client->id){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'this comment does not belong to you to edit :) ',
                ], 404);
        }

        $comment->update($request->only('content'));
        return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'comment updated successfully',
                ], 200);

    }

    /**
     * Remove the specified comment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteComment($id)
    {
        if(Comment::destroy($id)){
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'comment deleted successfully',
                ], 200);
        }

        return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'comment not found',
                ], 404);
        
    }

    /**
     * Get all comments for an event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEventComments($event_id)
    {
        $event = Event::find($event_id);

        $comments = Comment::where('event_id', '=', $event->id);

        if($event == null){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'event not found',
                ], 404);
        }


        if(!$event->comments->count()){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'this event has no comments yet',
                ], 404);
        }

        return response()->json(
                [
                    'status'    => 'success',
                    'data'      => $event->comments,
                    'message'   => null,
                ], 200);


    }
}
