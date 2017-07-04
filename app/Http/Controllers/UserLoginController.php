<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Redirect;
use View;

class UserLoginController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest');
    }

    /**
     * Shows login form.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function showLogin(Request $request)
    {
        /*
         * If there's an ajax request to the login page assume the person has been
         * logged out and redirect them to the login page
         */
        if ($request->ajax()) {
            return response()->json([
                'status'      => 'success',
                'redirectUrl' => route('login'),
            ]);
        }

        return View::make('Public.LoginAndRegister.Login');
    }

    /**
     * Handles the login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');

        $user = User::where('email', $email)->first();
        if($user){
            if(! $user->is_confirmed) {
                if(empty($user->first_name)){ // if this user is added by a parent user
                    $user->is_confirmed = 1;
                    $user->save();
                }
//                return 'You Are Not Confirmed yet';
                return Redirect::back()
                    ->with(['message' => 'You Are Not Confirmed yet', 'failed' => true])
                    ->withInput();
            }
        }

        if (empty($email) || empty($password)) {
            return Redirect::back()
                ->with(['message' => 'Please fill in your email and password', 'failed' => true])
                ->withInput();
        }

        if ($this->auth->attempt(['email' => $email, 'password' => $password], true) === false) {
            return Redirect::back()
                ->with(['message' => 'Your username/password combination was incorrect', 'failed' => true])
                ->withInput();
        }

        return redirect()->intended(route('showSelectOrganiser'));
    }
}
