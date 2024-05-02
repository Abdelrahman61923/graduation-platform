<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WelcomeOnBoardNotification;
use Throwable;

class SocialiteController extends Controller
{
    public function index($provider) {
        $user = Auth::user();

        $provider_user =  Socialite::driver($provider)->userFromToken($user->provider_token);
        dd($provider_user);
    }

    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {

        try{
            $provider_user = Socialite::driver($provider)->user();

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $provider_user->id,
            ])->first();

            $lastUser = User::users()->latest()->first();
            $currentYear = date('Y');
            $student_id = ''.$lastUser?($currentYear.''.$lastUser->id+1).'':$currentYear.'1';
            $username = ''.$lastUser?($provider_user->user['given_name'].''.$provider_user->user['family_name'].''.$lastUser->id+1).'':$provider_user->user['given_name'].''.$provider_user->user['family_name'].''.'1';

            $password = $this->generateRandomString();

            if(!$user) {
                $user = User::create([
                    'first_name' => $provider_user->user['given_name'],
                    'last_name' => $provider_user->user['family_name'],
                    'email' => $provider_user->email,
                    'student_id' => $student_id,
                    'password' => $password,
                    'username' => $username,
                    'is_change_password' => 1,
                    'provider' => $provider,
                    'provider_id' => $provider_user->id,
                    'provider_token' => $provider_user->token,
                ]);
                Notification::send($user, new WelcomeOnBoardNotification($password));
            }
            Auth::login($user);


            Alert::success('Successfully', 'User Created Successfully');
            return redirect()->route("students.dashboard");
        } catch (Throwable $e) {
            return redirect()->route('login')->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }

    public function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
