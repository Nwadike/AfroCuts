<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    // Protected $redirectTo = RouteServiceProvider::HOME; // Original redirect
    protected $redirectTo = '/dashboard'; // Redirect to the dashboard route

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        // You can add custom logic here after a user is authenticated
        // For example, checking for booking session data and redirecting
        // if (Session::has('booking_services')) {
        //     return redirect()->route('post_login_booking_handler'); // Example custom handler
        // }

        // Default redirect defined by $redirectTo
        return redirect()->intended($this->redirectPath());
    }
}
