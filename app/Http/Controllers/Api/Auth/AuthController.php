<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $device_name = $request->input('device_name', $request->userAgent());
            $token = $user->createToken($device_name);

            return response()->json([
                'code' => 100,
                'token' => $token->plainTextToken,
                'user' => $user,
                'message' => 'Logged in successfully',
                'redirect_to' => $user->role == User::ROLE_ADMIN ? route('admins.dashboard') : ($user->role == User::ROLE_USER ? route('students.dashboard') : route('supervisors.dashboard'))
            ], 201);
        }

        return response()->json([
            'code' => 0,
            'message' => 'Invalid credentials',
            'redirect_to' => route('login')
        ], 401);
    }

    public function showRegistrationForm()
    {
        $departments = Department::active()->get();
        return response()->json(['departments' => $departments], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'department_id' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $lastUser = User::latest()->first();
        $currentYear = date('Y');
        $student_id = $lastUser ? ($currentYear . ($lastUser->id + 1)) : $currentYear . '1';
        $username = $lastUser ? ($request->first_name . $request->last_name . ($lastUser->id + 1)) : $request->first_name . $request->last_name . '1';

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
            'is_change_password' => 1,
            'student_id' => $student_id,
            'username' => $username,
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'redirect_to' => route('students.dashboard'),
        ], 201);
    }

    public function destroy($token = null) {
        $user = Auth::guard('sanctum')->user();

        if (null === $token) {
            $user->currentAccessToken()->delete();
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);
        if ($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable_type){
            $personalAccessToken->delete();
        }
    }
}
