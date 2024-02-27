<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
    protected $redirectTo = '/home';

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated()
    {
        if (Auth::User()->role != User::ROLE_ADMIN) {
            // do your magic here
            if (Auth::User()->is_change_password) {
                if (Auth::User()->role == User::ROLE_USER) {
                    Alert::success('successfully', 'Logged In successfully');
                    return redirect()->route("students.dashboard");
                } else {
                    Alert::success('successfully', 'Logged In successfully');
                    return redirect()->route("supervisors.dashboard");
                }
            } else {
                return redirect()->route("passwords.change-password");
            }
        } else if (Auth::User()->role == User::ROLE_ADMIN) {
            Alert::success('successfully', 'Logged In successfully');
            return redirect()->route("admins.dashboard");
        } else {
            Auth::logout();
            Alert::error("Error","Credintials not valid");
            return redirect()->route('login');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}
