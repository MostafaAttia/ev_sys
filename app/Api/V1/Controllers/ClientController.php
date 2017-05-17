<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Transformers\ClientTransformer;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Log;
use Validator;

use Illuminate\Support\Facades\Mail;

use Dingo\Api\Routing\Helpers;

use JWTAuth;


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

        if($client_id !== 'null')
        {
            $client = Client::findOrFail($client_id);

            return $this->response->item($client, new ClientTransformer);
        }

        if($client_email !== 'null')
        {
            $client = Client::whereEmail($client_email)->first();

            return $this->response->item($client, new ClientTransformer);
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

        // if($request->has('password')){
        //     Mail::send('Emails.ClientPasswordChanged',
        //         ['first_name' => $client->first_name, 'password' => $request->get('password')],
        //         function ($message) use ($client) {
        //             $message->to($client->email, $client->first_name)
        //                 ->subject('Security alert for your account @ Vitee');
        //     });
        // }

        return response()->json(
                [
                    'status'    => 'success',
                    'data'      => null,
                    'message'   => 'User Updated successfully',
                ], 200);

    }





}
