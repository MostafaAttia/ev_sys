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

use Dingo\Api\Routing\Helpers;


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
     * <strong>Parameters:</strong>
     * <br>
     * first_name   : optional|max:56|min:4 <br>
     * last_name    : optional|max:56|min:4 <br>
     * email        : optional|email|unique <br>
     * gender       : optional|in:male,female <br>
     * dob          : optional|date <br>
     * phone        : optional|max:15|min:4 <br>
     * address      : optional|string|min:10|max:255 <br>
     *
     *
     * @param Request $request
     * @param $client_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateClient(Request $request, $client_id)
    {

        $validator = Validator::make($request->all(), [
            'first_name'    => 'max:56|min:4',
            'last_name'     => 'max:56|min:4',
            'email'         => 'email|unique:clients',
            'gender'        => 'in:male,female',
            'dob'           => 'date',
            'phone'         => 'max:15|min:4',
            'address'       => 'string|min:10|max:255'
        ]);

        if($validator->fails())
        {
            return $validator->errors()->all();
        }

        $client = Client::findOrFail($client_id);

        $client->update($request->all());

        return response()->json(['message' => 'Client Updated!'], 200);

    }





}
