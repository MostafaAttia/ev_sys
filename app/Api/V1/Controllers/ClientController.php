<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\ClientTransformer;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Models\Client;
use League\Fractal;
use Validator;
use JWTAuth;
use Image;
use Auth;
use Log;


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
                    'message'   => 'you can not change your email from here! :( ',
                ], 404);
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
                    'message'   => $validator->errors()->all(),
                ], 404);
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
