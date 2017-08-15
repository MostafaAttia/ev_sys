<?php
/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 13/06/17
 * Time: 10:15 م
 */

namespace App\Http\Controllers;

use App\Api\V1\Transformers\ClientTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Dingo\Api\Routing\Helpers;
use App\Models\Client;
use App\Http\Requests;
use League\Fractal;
use Auth;
use Validator;
use JWTAuth;


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

    public function showClientProfile($client_id)
    {

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new Fractal\Serializer\ArraySerializer());

        $auth_client = Client::findOrFail($client_id);
        $client_obj = new Fractal\Resource\Item($auth_client, new ClientTransformer);
        $client = $fractal->createData($client_obj)->toArray();

        $title = $client['first_name'] . '\' Profile';

        return view('Front.Client.Profile', compact('client', 'title'));

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
    public function updateClient(Request $request, $client_id)
    {
        $user = Client::findOrFail($client_id);

        Log::info($request->all());

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
                ], 200);
        }

        $user->update($request->except('email'));
        return response()->json(
            [
                'status'    => 'success',
                'data'      => null,
                'message'   => 'User Updated successfully',
            ], 200);

    }



}