<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Dingo\Api\Routing\Helpers;

class UserLogoutController extends Controller
{
    use Helpers;

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Log a user out and redirect them
     *
     * @return mixed
     */
    public function doLogout()
    {
        $this->auth->logout();

        return $this->response->array(['message' => 'You Are Now Logged out!']);

//        return redirect()->to('/?logged_out=yup');
    }
}
