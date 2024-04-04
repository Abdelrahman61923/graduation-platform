<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::find(Auth::id());
        $hashedPassword = $user->password;

        if (Hash::check($request->old_password, $hashedPassword)) {

            $hashedNewPassword = Hash::make($request->password);
            $user->password = $hashedNewPassword;
            $user->is_change_password = 1;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully',
                'redirect' => $this->getDashboardRoute($user->role)
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Old password does not match'
            ], 400);
        }
    }

    private function getDashboardRoute($role)
    {
        if ($role == User::ROLE_USER) {
            return route('students.dashboard');
        } elseif ($role == User::ROLE_SUPERVISOR) {
            return route('supervisors.dashboard');
        } else {
            return route('admins.dashboard');
        }
    }
}
