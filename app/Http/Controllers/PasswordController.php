<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|different:password',
            'password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $hashedPassword = $user->password;

        if (Hash::check($request->old_password, $hashedPassword)) {

            $hashedNewPassword = Hash::make($request->password);
            $user->password = $hashedNewPassword;
            $user->is_change_password = 1;
            $user->save();

            Alert::success('successfully', 'Password Updated successfully');
            if ($user->role == User::ROLE_USER) {
                return redirect()->route('students.dashboard');
            } elseif ($user->role == User::ROLE_SUPERVISOR) {
                return redirect()->route('supervisors.dashboard');
            } else {
                return redirect()->route('admins.dashboard');
            }

        } else {
            Alert::error('Oops', 'old password doesnt matched');
            return back();
        }
    }
    public function skip(Request $request)
    {
        $user = User::find(Auth::id());

        $user->is_change_password = 1;
        $user->save();

        Alert::success('successfully', 'Login successfully');
        if ($user->role == User::ROLE_USER) {
            return redirect()->route('students.dashboard');
        } elseif ($user->role == User::ROLE_SUPERVISOR) {
            return redirect()->route('supervisors.dashboard');
        } else {
            return redirect()->route('admins.dashboard');
        }

    }
}
