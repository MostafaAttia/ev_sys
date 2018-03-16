<?php
/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 13/06/17
 * Time: 10:15 م
 */

namespace App\Http\Controllers;

use App\Api\V1\Transformers\CategoryTransformer;
use App\Api\V1\Transformers\ClientTransformer;
use App\Api\V1\Transformers\OrganiserTransformer;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organiser;
use App\Notifications\OrganiserFollowed;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests;
use League\Fractal;
use LaravelPusher;
use Validator;
use JWTAuth;
use Auth;


class ClientController extends Controller
{
    use Helpers;

    /**
     * Confirm email
     *
     * @param $confirmation_code
     * @return mixed
     */
    public function confirmEmail($confirmation_code)
    {
        $client = Client::whereConfirmationCode($confirmation_code)->first();

        if (!$client) {
            return view('Public.Errors.Generic', [
                'message' => 'The confirmation code is missing or malformed.',
            ]);
        }

        $client->is_email_confirmed = 1;
        $client->confirmation_code = null;
        $client->save();

        Session::flash('message', [
            'content'   => 'Your email successfully confirmed, Now you can login!',
            'type'      => 'success' // alert, success, error, warning, info
        ]);

        return redirect()->intended('home');
    }

    public function showClientProfile()
    {

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = Auth::guard('client')->user();
        $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
        $client = $fractal->createData($client_obj)->toArray();

        $title = $client['first_name'] . '\' Profile';

        return view('Front.Client.Profile', compact('client', 'title'));

    }

    public function showClientSettings()
    {
        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = Auth::guard('client')->user();
        $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
        $client = $fractal->createData($client_obj)->toArray();
        $meta = $auth_client->meta;
        $title = $client['first_name'] . '\' Preferences';

        $organisers = $auth_client->followings(\App\Models\Organiser::class)->get();
        $organisers_ids = $organisers->pluck('id')->toArray();

        $organisers_array = [];
        foreach($organisers as $organiser){
            $organiser = new Fractal\Resource\Item($organiser, new OrganiserTransformer);
            $organiser = $fractal->createData($organiser)->toArray();
            array_push($organisers_array, $organiser);
        }

        $organisers = $organisers_array;

        $categories = $auth_client->favorites(\App\Models\Category::class)->get();
        $categories_array = [];
        foreach($categories as $category){
            $category = new Fractal\Resource\Item($category, new CategoryTransformer);
            $category = $fractal->createData($category)->toArray();
            array_push($categories_array, $category);
        }

        $categories = $categories_array;

        $followings = count($organisers);
        $likes = count($auth_client->likes(\App\Models\Event::class)->get());
        $favorites = count($categories);
        $counters = [
            'followings'    => $followings,
            'likes'         => $likes,
            'favorites'     => $favorites
        ];

        return view('Front.Client.Settings', compact('client', 'meta', 'counters' , 'categories', 'organisers', 'organisers_ids', 'title'));
    }

    /**
     * Update/Edit User
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
        $user = Auth::guard('client')->user();

        if($request->has('email') || $request->has('password')){
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => 'you can not change your email/password from here! :( ',
                ], 401);
        }

        $validator = Validator::make($request->all(), [
            'first_name'    => 'filled|min:3|max:56',
            'last_name'     => 'filled|min:3|max:56',
            'dob'           => 'filled|date',
            'phone'         => 'filled|max:15|min:4',
            'address'       => 'filled|string|min:10|max:255'
        ]);

        if($validator->fails())
        {
            return response()->json(
                [
                    'status'    => 'error',
                    'data'      => null,
                    'message'   => $validator->errors()->all(),
                ], 400);
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
     * Update client preferences
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClientPreferences(Request $request)
    {
        $client = Auth::guard('client')->user();
        $meta = [
            'show_email'            => $request->has('email') ? 1 : 0,
            'show_gender'           => $request->has('gender') ? 1 : 0,
            'show_phone'            => $request->has('phone') ? 1 : 0,
            'show_address'          => $request->has('address') ? 1 : 0,
            'show_followings'       => $request->has('followings') ? 1 : 0,
            'show_favorites'        => $request->has('favorites') ? 1 : 0,
            'show_likes'            => $request->has('likes') ? 1 : 0,
            'show_attended_events'  => $request->has('attended') ? 1 : 0,
        ];

        $client->meta()->update($meta);
        Session::flash('notification', [
            'content'   => 'Preferences updated successfully!',
            'type'      => 'success' // alert, success, error, warning, info
        ]);
        return redirect()->back();

    }

    /**
     * Update client notifications preferences
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClientNotificationsPreferences(Request $request)
    {
        $client = Auth::guard('client')->user();
        $meta = [
            'get_notif_about_followings'    => $request->has('notif_followings') ? 1 : 0,
            'get_notif_about_favorites'     => $request->has('notif_favorites') ? 1 : 0,
            'get_mail_notif'                => $request->has('notif_email') ? 1 : 0,
        ];

        $client->meta()->update($meta);
        Session::flash('notification', [
            'content'   => 'Notifications\' Preference updated successfully!',
            'type'      => 'success' // alert, success, error, warning, info
        ]);
        return redirect()->back();

    }

    /**
     * Get latest 5 unread notifications as array
     */
    public function notifications()
    {
        return Auth::guard('client')->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    /**
     * Follow Organiser
     */
    public function followOrganiser($organiser_id)
    {
        $client = Auth::guard('client')->user();
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

            $organiser->notify(new OrganiserFollowed($client));

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
                    'message'   => $client ? 'organiser was not found!' : 'something went wrong, please try again later!',
                ], 404);
        }

    }

    /**
     * Unfollow Organiser
     */
    public function unfollowOrganiser($organiser_id)
    {
        $client = Auth::guard('client')->user();
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
                    'message'   => $client ? 'organiser was not found!' : 'something went wrong, please try again later!',
                ], 404);
        }

    }

    /**
     * Favorite a Category
     */
    public function favoriteCategory($category_id)
    {
        $client = Auth::guard('client')->user();
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
     */
    public function unfavoriteCategory($category_id)
    {
        $client = Auth::guard('client')->user();
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
     */
    public function likeEvent($event_id)
    {
        $client = Auth::guard('client')->user();
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
     */
    public function unlikeEvent($event_id)
    {
        $client = Auth::guard('client')->user();
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
     * return number of event likers
     * @param $event_id
     * @return int
     */
    public function eventLikes($event_id)
    {
        $event = Event::find($event_id);
        return count($event->likers()->get()->pluck('id')->toArray());
    }

    /**
     * return number of category fans
     * @param $category_id
     * @return int
     */
    public function categoryFans($category_id)
    {
        $category = Category::find($category_id);
        return count($category->favoriters()->get()->pluck('id')->toArray());
    }

    /**
     * return number of organiser's followers
     * @param $organiser_id
     * @return int
     */
    public function organiserFollowers($organiser_id)
    {
        $organiser = Organiser::find($organiser_id);
        return count($organiser->followers()->get()->pluck('id')->toArray());
    }


}