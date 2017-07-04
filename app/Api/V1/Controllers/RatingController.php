<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use JWTAuth;

use App\Models\Rating;
use App\Models\Event;


class RatingController extends Controller
{

    use Helpers;

    /**
     * Post/Update rating for event
     *
     * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for current user
     *
     * <strong>Parameters:</strong>
     * <br>
     * rating   : required|in:1,2,3,4,5 <br>
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRating(Request $request, $event_id)
    {

        $user = JWTAuth::parseToken()->toUser();
        $event = Event::find($event_id);

        // Todo
        // if($user !== $attendee)

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
                    'message'   => "you can't rate this event yet.",
                ], 404);
        }

        

        $validator = \Validator::make($request->all(), [
            'rating'    => 'required|in:1,2,3,4,5'
        ]);

        if($validator->fails())
        {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors()->all(),
                ], 404);
        }

        $rating = Rating::where(['client_id'=> $user->id, 'event_id'=> $event->id])->first();

        if($rating !== null){
            if($rating->update(['rating'=>$request->get('rating')])){
                return response()->json(
                        [
                            'status'    => 'success',
                            'data'      => null,
                            'message'   => 'thanks for rating',
                        ], 200);
                }
        }

        $rating = new Rating();

        $rating->rating = $request->get('rating');
        $rating->event_id = $event_id;
        $rating->client_id = $user->id;

        if($rating->save()){
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'thanks for rating',
                ], 200);
        }
    }

    /**
     * delete user's rating
     *
     * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for current user
     *
     *
     * @param int $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRating($event_id)
    {
        $user = JWTAuth::parseToken()->toUser();
        $event = Event::find($event_id);

        if($event == null){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'event not found',
                ], 404);
        }

        $rating = Rating::where(['client_id'=> $user->id, 'event_id'=> $event->id])->first();

        if($rating == null){
            return response()->json(
                    [
                        'status'    => 'error',
                        'data'      => null,
                        'message'   => 'rating not found!',
                    ], 404);
        }

        if($rating->delete()){
            return response()->json(
                 [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'rating has been deleted!',
                ], 200);
        }
    }

}
