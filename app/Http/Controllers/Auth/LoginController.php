<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use DB;
use Lang;
use Illuminate\Http\Request;
use View;
use Illuminate\Foundation\Auth\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');


    }


    protected function authenticated($user)
    {
      session(['status' => 'Logged in succesfully!']);
    }




    public function showLoginForm()
    {
      $DBcategories = DB::table('categories')->get();
        //need for poll
        $allvotes = 0;
        $DBpoll = DB::table('poll')->get();
        $DBvotes = DB::table('pollvotes')->select('id')->get();
        foreach ($DBvotes as $vote) {
            $allvotes++;
        }
        //end

      return view('auth.login', compact('title'), ['DBcategories' => $DBcategories, 'DBpoll' => $DBpoll, 'allvotes' => $allvotes]);
    }

    //NEEDED FOR ERRORS LOGIN
    protected function sendFailedLoginResponse(Request $request)
    {

        if ( ! User::where('email', $request->email)->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'email' => Lang::get('Wrong email address!'),
                ]);
        }

        if ( ! User::where('email', $request->email)->where('password', bcrypt($request->password))->first() ) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    'password' => Lang::get('Password is incorrect!'),
                ]);
        }

    }
}
