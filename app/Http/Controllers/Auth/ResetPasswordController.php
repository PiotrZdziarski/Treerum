<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    public function showResetForm($token)
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

      return view('auth.passwords.reset', compact('title'), ['DBcategories' => $DBcategories, 'token' => $token, 'DBpoll' => $DBpoll, 'allvotes' => $allvotes]);
    }
}
