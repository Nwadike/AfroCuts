<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to their respective dashboards based on account type.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * This is unused since we override `authenticated()`.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard'; // Default fallback, not used in practice

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     * Redirect based on account_type.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        switch ($user->account_type) {
            case 'superadmin':
                return redirect()->route('superadmin.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'business':
                return redirect()->route('business.dashboard');
            case 'regular':
            default:
                return redirect()->route('user.dashboard');
        }
    }
}
