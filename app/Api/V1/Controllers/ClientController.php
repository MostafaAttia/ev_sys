<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\ClientTransformer;
use App\Api\V1\Transformers\EventTransformer;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organiser;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Models\Client;
use League\Fractal;
use Validator;
use JWTAuth;
use Image;
use Auth;
use Log;

use LaravelPusher;
use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\OrganiserTransformer;


class ClientController extends Controller
{

    use Helpers;


    /**
     * Get User Details by ID OR Email
     *
     * <strong>Parameters:</strong>
     * <br>
     * ID             : optional_if|min:6 <br>
     * email          : optional_if|email|unique <br>
     *
     * if you want to get details by email, first param will be null.
     *
     * @param null $client_id
     * @param null $client_email
     * @return \Dingo\Api\Http\Response
     */
    public function getClientDetails($client_id = null, $client_email = null)
    {

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        if($client_id !== 'null')
        {
            $client = Client::findOrFail($client_id);
            $client = new Fractal\Resource\Item($client, new ClientTransformer);
            $client = $fractal->createData($client)->toArray();
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => $client,
                    'message'   => null,
                ], 200);

        }

        if($client_email !== 'null')
        {
            $client = Client::whereEmail($client_email)->first();
            $client = new Fractal\Resource\Item($client, new ClientTransformer);
            $client = $fractal->createData($client)->toArray();
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => $client,
                    'message'   => null,
                ], 200);
        }

    }

    /**
     * Update/Edit User
     *
     * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * <strong>Parameters:</strong>
     * <br>
     * first_name   : optional|max:56 <br>
     * last_name    : optional|max:56 <br>
     * password     : optional|min:6 <br>
     * password_confirmation: required_with:password|min:6 <br>
     * gender       : optional|in:male,female <br>
     * dob          : optional|date "YYYY-MM-DD" <br>
     * phone        : optional|string|max:15|min:4 <br>
     * address      : optional|string|min:10|max:255 <br>
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClient(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();

        if($request->has('email')){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'you can not change your email from here!',
                ], 401);
        }

        $validator = Validator::make($request->all(), [
            'first_name'    => 'max:56',
            'last_name'     => 'max:56',
            'password'      => 'min:6|confirmed',
            'gender'        => 'in:male,female',
            'dob'           => 'date',
            'phone'         => 'max:15|min:4',
            'address'       => 'string|min:10|max:255'
        ]);

        if($validator->fails())
        {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors(),
                ], 401);
        }

        $user->update($request->except('email'));
        return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'User Updated successfully',
                ], 200);

    }


    /**
     * Follow Organiser
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * <strong>Parameters:</strong>
     * <br>
     * organiser_id
     *
     * @param $organiser_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function followOrganiser($organiser_id)
    {
        $client = JWTAuth::parseToken()->toUser();
        $organiser = Organiser::find($organiser_id);

        if($client && $organiser)
        {
            $fractal = new Fractal\Manager();
            $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

            $client_obj = new Fractal\Resource\Item($client, new ClientTransformer);
            $transformed_client = $fractal->createData($client_obj)->toArray();
            $transformed_client = array_only($transformed_client, [
                'id',
                'first_name',
                'last_name',
                'image_path',
            ]);

            $organiser_obj = new Fractal\Resource\Item($organiser, new OrganiserTransformer);
            $transformed_organiser = $fractal->createData($organiser_obj)->toArray();
            $transformed_organiser = array_only($transformed_organiser, [
                'id',
                'name',
                'image_path',
            ]);


            $client->follow($organiser);

            $client_name = $client->first_name . ' ' .$client->last_name;
            $message = [
                'info'      => [
                    'client' => $transformed_client,
                    'organiser' => $transformed_organiser
                ],
                'message'   => $client_name . ' is now following you!',
            ];

            LaravelPusher::trigger('organiser_notifications', 'new_follower', $message);

            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => $message,
                    'message'   => 'You are following ' . $organiser->name,
                ], 200);



        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $client ? 'organiser not found!' : 'something went wrong, please try again later!',
                ], 404);
        }

    }

    /**
     * Unfollow Organiser
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * <strong>Parameters:</strong>
     * <br>
     * organiser_id
     *
     * @param $organiser_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollowOrganiser($organiser_id)
    {
        $client = JWTAuth::parseToken()->toUser();
        $organiser = Organiser::find($organiser_id);

        if($client && $organiser)
        {
            $client->unFollow($organiser);
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'You will no longer get notifications about new events from ' . $organiser->name,
                ], 200);
        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $client ? 'organiser not found!' : 'something went wrong, please try again later!',
                ], 404);
        }

    }

    /**
     * Favorite a Category
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * <strong>Parameters:</strong>
     * <br>
     * category_id
     *
     * @param $category_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoriteCategory($category_id)
    {
        $client = JWTAuth::parseToken()->toUser();
        $category = Category::find($category_id);

        if($client && $category)
        {
            $client->favorite($category);
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => $category,
                    'message'   => 'You favorite ' . $category->name,
                ], 200);

        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $client ? 'category not found!' : 'something went wrong, please try again later!',
                ], 404);
        }

    }

    /**
     * UnFavorite a Category
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * <strong>Parameters:</strong>
     * <br>
     * category_id
     *
     * @param $category_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfavoriteCategory($category_id)
    {
        $client = JWTAuth::parseToken()->toUser();
        $category = Category::find($category_id);

        if($client && $category)
        {
            $client->unfavorite($category);
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'You unfavorite ' . $category->name,
                ], 200);

        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $client ? 'category not found!' : 'something went wrong, please try again later!',
                ], 404);
        }
    }

    /**
     * Like an Event
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * <strong>Parameters:</strong>
     * <br>
     * event_id
     *
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeEvent($event_id)
    {
        $client = JWTAuth::parseToken()->toUser();
        $event = Event::find($event_id);

        if($client && $event)
        {
            $client->like($event);
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => array_only($event->toArray(), [
                        'id',
                        'title',
                    ]),
                    'message'   => 'You like ' . $event->title,
                ], 200);

        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $client ? 'event not found!' : 'something went wrong, please try again later!',
                ], 404);
        }
    }

    /**
     * Unlike an Event
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * <strong>Parameters:</strong>
     * <br>
     * event_id
     *
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function unlikeEvent($event_id)
    {
        $client = JWTAuth::parseToken()->toUser();
        $event = Event::find($event_id);

        if($client && $event)
        {
            $client->unlike($event);
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'You unlike ' . $event->title,
                ], 200);

        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $client ? 'event not found!' : 'something went wrong, please try again later!',
                ], 404);
        }
    }

    /**
     * count event likers
     *
     * <strong>Parameters:</strong>
     * <br>
     * event_id
     *
     * @param $event_id
     * @return int
     */
    public function eventLikes($event_id)
    {
        $event = Event::find($event_id);

        if($event)
        {
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => ['likes'   => count($event->likers()->get()->pluck('id')->toArray())],
                    'message'   => null,
                ], 200);

        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'event not found',
                ], 404);
        }
    }

    /**
     * count category fans
     *
     * <strong>Parameters:</strong>
     * <br>
     * category_id
     *
     * @param $category_id
     * @return int
     */
    public function categoryFans($category_id)
    {
        $category = Category::find($category_id);

        if($category)
        {
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => ['fans'   => count($category->favoriters()->get()->pluck('id')->toArray())],
                    'message'   => null,
                ], 200);

        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'category not found',
                ], 404);
        }
    }

    /**
     * count organiser's followers
     *
     * <strong>Parameters:</strong>
     * <br>
     * organiser_id
     *
     * @param $organiser_id
     * @return int
     */
    public function organiserFollowers($organiser_id)
    {
        $organiser = Organiser::find($organiser_id);

        if($organiser)
        {
            return response()->json(
                [
                    'status'    => 'success',
                    'data'      => ['fans'   => count($organiser->followers()->get()->pluck('id')->toArray())],
                    'message'   => null,
                ], 200);

        } else {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'organiser not found',
                ], 404);
        }
    }


    /**
     * Get Events posted by organizers who are being followed by this client
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getFollowingsEvents()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = JWTAuth::parseToken()->toUser();
        $following = $auth_client->followings(Organiser::class)->get()->pluck('id')->toArray();

        $eventsOriginal = Event::whereIn('organiser_id', $following)
            ->where('is_live', '=', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->inRandomOrder()
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value){
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);
    }

    /**
     * Get Events from client's favorites categories
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getFavoritesCategoriesEvents()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = JWTAuth::parseToken()->toUser();
        $favorites = $auth_client->favorites(Category::class)->get()->pluck('id')->toArray();

        $eventsOriginal = Event::whereIn('category_id', $favorites)
            ->where('is_live', '=', 1)
            ->where('end_date', '>', date("Y-m-d H:i:s"))
            ->orderBy('start_date', 'asc')
            ->paginate(10);

        $events = new Fractal\Resource\Collection($eventsOriginal, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        foreach($eventsOriginal->toArray() as $key=>$value){
            if($key == 'data') continue;
            $events[$key] = $value;
        }

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);

    }

    /**
     * Get organizers who are being followed by this client
     *
     * * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * @return \Dingo\Api\Http\Response
     */
    public function followings()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = JWTAuth::parseToken()->toUser();
        $following = $auth_client->followings(Organiser::class)->get();

        $organisers = new Fractal\Resource\Collection($following, new OrganiserTransformer);
        $organisers = $fractal->createData($organisers)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $organisers['data'],
                'message'   => null,
            ], 200);
    }

    /**
     * Get categories that are being favorite by this client
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * @return \Dingo\Api\Http\Response
     */
    public function favorites()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = JWTAuth::parseToken()->toUser();
        $favorites = $auth_client->favorites(Category::class)->get();

        $categories = new Fractal\Resource\Collection($favorites, new CategoryTransformer);
        $categories = $fractal->createData($categories)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $categories['data'],
                'message'   => null,
            ], 200);
    }

    /**
     * Get events that are being liked by this client
     *
     * * <strong>Required:</strong><br>
     *
     * header: Authorization "token" for this user
     *
     * @return \Dingo\Api\Http\Response
     */
    public function likes()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = JWTAuth::parseToken()->toUser();
        $liked_events = $auth_client->likes(Event::class)->get();

        $events = new Fractal\Resource\Collection($liked_events, new EventTransformer);
        $events = $fractal->createData($events)->toArray();

        return response()->json(
            [
                'status'    => 'success',
                'data'      => $events['data'],
                'message'   => null,
            ], 200);
    }



}
