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
use Intervention\Image\Facades\Image;
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
            Session::flash('notification', [
                'content'   => 'Please make sure your email/password are correct!',
                'type'      => 'error' // alert, success, error, warning, info
            ]);

            return redirect()->intended('home');
        }

        $client = Client::where('email', $request->get('email'))->first();
        if($client){
            if(! $client->is_email_confirmed) {
                Session::flash('notification', [
                    'content'   => 'Please confirm your email first!',
                    'type'      => 'error' // alert, success, error, warning, info
                ]);

                return redirect()->intended('home');
            }
        } else {
            Session::flash('notification', [
                'content'   => 'your email is incorrect!',
                'type'      => 'error' // alert, success, error, warning, info
            ]);

            return redirect()->back();
        }


        if (Auth::guard('client')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            // Authentication passed...
            return redirect()->back();
        } else {
            Session::flash('notification', [
                'content'   => 'invalid password!',
                'type'      => 'error' // alert, success, error, warning, info
            ]);

            return redirect()->back();
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
            'gender'        => 'in:male,female',
            'dob'           => 'date',
            'phone'         => 'max:15|min:4',
            'address'       => 'string|min:10|max:255',
            'image'         => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=300,min_height=300',
        ]);

        $client_data = $request->all();
        $client_data['confirmation_code'] = str_random();

        // upload user image
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = 'img_'.md5(time(). str_random()).'.'.$image->getClientOriginalExtension();
            $client_data['image_path'] = $imageName;

            Storage::disk('s3')->put('user_content/original/'.$imageName, file_get_contents($image), 'public');

            // save as THUMB 60*?
            $image_thumb_60_60 = Image::make($image)->resize(60, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('user_content/60*60/'.$imageName, $image_thumb_60_60->__toString(), 'public');

            // save as THUMB 120*?
            $image_thumb_120_120 = Image::make($image)->resize(120, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('user_content/120*120/'.$imageName, $image_thumb_120_120->__toString(), 'public');

            // save as VERTICAL poster 240*?
            $image_vert_poster_240_240 = Image::make($image)->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();
            Storage::disk('s3')->put('user_content/240*240/'.$imageName, $image_vert_poster_240_240->__toString(), 'public');

        }

        $client = Client::create($client_data);

        // TODO: Do this async?
        Mail::send('Emails.ClientConfirmEmail',
            ['first_name' => $client->first_name, 'confirmation_code' => $client->confirmation_code],
            function ($message) use ($request) {
                $message->to($request->get('email'), $request->get('first_name'))
                    ->subject('Thank you for registering for Vitee');
            });

        Session::flash('notification', [
            'content'   => 'We have sent a confirmation email to '. $request->get('email') . ', Please confirm your email and then login!',
            'type'      => 'success' // alert, success, error, warning, info
        ]);

        return redirect()->intended('/home');

    }


}
