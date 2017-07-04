<?php
/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 13/06/17
 * Time: 10:05 م
 */

namespace App\Http\Controllers\ClientAuth;

use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Models\Client;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $auth;

    protected $guard = 'client';

    protected $redirectTo = '/home';
    protected $redirectAfterLogout = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     * @param \Illuminate\Contracts\Auth\Registrar $registrar
     *
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
    }


    /**
     *  Login and redirect client
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            Session::flash('message', [
                'content'   => 'Please make sure your email/password are correct!',
                'type'      => 'error' // alert, success, error, warning, info
            ]);

            return redirect()->intended('home');
        }

        $client = Client::where('email', $request->get('email'))->first();
        if($client){
            if(! $client->is_email_confirmed) {
                Session::flash('message', [
                    'content'   => 'Please confirm your email first!',
                    'type'      => 'error' // alert, success, error, warning, info
                ]);

                return redirect()->intended('home');
            }
        } else {
            Session::flash('message', [
                'content'   => 'your email is incorrect!',
                'type'      => 'error' // alert, success, error, warning, info
            ]);

            return redirect()->intended('home');
        }


        if (Auth::guard('client')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            // Authentication passed...
            return redirect()->intended('home');
        } else {
            Session::flash('message', [
                'content'   => 'invalid password!',
                'type'      => 'error' // alert, success, error, warning, info
            ]);

            return redirect()->intended('home');
        }
    }


    /**
     * Sign Up
     *
     * <strong>Parameters:</strong>
     * <br>
     * first_name           : required <br>
     * last_name            : required <br>
     * email                : required|email|unique <br>
     * password             : required|min:6 <br>
     * password_confirmation: required <br>
     * <br>
     * gender               : optional|in:male,female <br>
     * dob                  : optional|date <br>
     * phone                : optional|max:15|min:4 <br>
     * address              : optional|string|min:10|max:255 <br>
     * image                : optional|image|mimes:jpeg,png,jpg|max:2048 bytes <br>
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function signup(Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required|max:56',
            'last_name'     => 'required|max:56',
            'email'         => 'required|email|unique:clients',
            'password'      => 'required|min:6|confirmed',
//            'gender'        => 'in:male,female',
//            'dob'           => 'date',
//            'phone'         => 'max:15|min:4',
//            'address'       => 'string|min:10|max:255',
//            'image'         => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=300,min_height=300',
        ]);

        $client_data = $request->all();
        $client_data['confirmation_code'] = str_random();

        if($image = $request->file('image')){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $t = Storage::disk('s3')->put('user_content/'.$imageName, file_get_contents($image), 'public');
            $imageName = Storage::disk('s3')->url('user_content/'.$imageName);
            $client_data['image_path'] = $imageName;
        }

        $client = Client::create($client_data);

        // TODO: Do this async?
        Mail::send('Emails.ClientConfirmEmail',
            ['first_name' => $client->first_name, 'confirmation_code' => $client->confirmation_code],
            function ($message) use ($request) {
                $message->to($request->get('email'), $request->get('first_name'))
                    ->subject('Thank you for registering for Vitee');
            });

        Session::flash('message', [
            'content'   => 'We have sent a confirmation email to '. $request->get('email') . ', Please confirm your email and then login!',
            'type'      => 'success' // alert, success, error, warning, info
        ]);

        return redirect()->intended('/home');

    }


}
