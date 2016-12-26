<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Organiser;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Session;
use Validator;
use Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreate()
    {
        $user = Sentinel::check();
        $page_title = 'Create Admin';
        $roles = Sentinel::getRoleRepository()->lists('name', 'id')->all();
        return  view('admin.ManageAdmin.create', compact('user', 'page_title', 'roles'));
    }

    public function postCreate(Request $request)
    {

        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:admins',
            'password'      => 'required|confirmed|min:6',
        ]);

        $credentials = $request->all();
        $role = Sentinel::findRoleById($credentials['role_id']);


        if($user = Sentinel::registerAndActivate($credentials)){
            Session::flash('admin_message', $role->name . " has been created successfully !");
            $role->users()->attach($user);
            return redirect()->route('admin.manage');
        }
    }

    /**
     * Show the form for register
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return  view('admin.auth.register');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:admins',
            'password'      => 'required|confirmed|min:6',
        ]);

        $credentials = $request->all();

        if(Sentinel::registerAndActivate($credentials)){
            return redirect()->route('admin.login');
        }

    }

    /**
     * Show Admin login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin()
    {
        if ($user = Sentinel::check())
        {
            return redirect()->route('admin.dashboard', $user);
        }

        return view('admin.auth.login');
    }

    /**
     * Authenticate admin for login
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required',
        ]);

        $credentials = $request->all();
        $remember = false;

        if(array_key_exists('remember', $credentials)){
            $remember = true;
        }

        try {
            if($user = Sentinel::authenticate($credentials, $remember)){
                Sentinel::login($user);
                return redirect()->route('admin.dashboard');
            }
            Session::flash('message', "Your email/password combination do not match!");
            return redirect()->back();

        } catch(NotActivatedException $e) {
            Session::flash('message', "Your account has not been activated yet.");
            return redirect()->back();
        } catch(ThrottlingException $e) {
            $min = intval($e->getDelay()  / 60);
            $timeToGo =  $min . ':' . str_pad(($e->getDelay() % 60), 2, '0', STR_PAD_LEFT);
            Session::flash('message', "Your IP is blocked, You will have to wait ". $timeToGo . " minutes");
            return redirect()->back();
        }

    }

    /**
     * Show Admin Dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showDashboard()
    {
        $user = Sentinel::check();

        return view('admin.dashboard', compact('user'));
    }

    public function showManage()
    {
        $admins = Admin::all();
        $page_title = 'Manage Admins';
        return view('admin.ManageAdmin.manage', compact('admins', 'page_title'));
    }

    /**
     * Do logout for admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        if ($user = Sentinel::check())
        {
            Sentinel::logout($user, true);
        }

        return redirect()->route('admin.login');

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.ManageAdmin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        if($admin->update($request->all())){
            Session::flash('admin_message', "Admin " . $admin->first_name . " " . $admin->last_name . " has been updated successfully !");
            return redirect()->route('admin.manage');
        } else {
            Session::flash('admin_message', "Whoops! Failed To Update Admin !");
            return redirect()->route('admin.manage');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if($admin->delete()){
            Session::flash('admin_message', 'Admin ' .  $admin->first_name . ' ' . $admin->last_name. ' has been deleted successfully !');
            return redirect()->route('admin.manage');
        } else {
            Session::flash('admin_message', "Whoops! Failed To Delete Admin !");
            return redirect()->route('admin.manage');
        }
    }

    public function showAllOrganisers()
    {
        $organisers = Organiser::all();
        $page_title = 'Manage Organisers';

        return view('admin.ManageOrganisers.manage', compact('organisers', 'page_title'));
    }

}
