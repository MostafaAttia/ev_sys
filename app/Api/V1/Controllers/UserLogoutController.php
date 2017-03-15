<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;
use JWTAuth;

class UserLogoutController extends Controller
{
    use Helpers;

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Log Out
     *
     * @return mixed
     */
    public function doLogout(Request $request)
    {
        // $this->auth->logout();
        $header = $request->header('Authorization');

        $token = ltrim($header,"Bearer");

        JWTAuth::invalidate($token);

    }
}
