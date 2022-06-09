<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/admin/articulos';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $logs = new \App\Logs();
            $logs->id_users = Auth::user()->id;
            $logs->save();
            return $this->sendLoginResponse($request);
        }

        $email = $request->get($this->username());

        $client = \App\User::where($this->username(), $email)->first();

        if($client!=null){
          $this->incrementLoginAttempts($request);

          if ($client->status === 0) {
              return $this->sendFailedLoginResponse($request, 'auth.failed_status');
          }
          return $this->sendFailedLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);

    }

    public function username()
    {
        \Session::forget('notificationalert');
        return 'login';
    }
}
