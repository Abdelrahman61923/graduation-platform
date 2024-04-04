<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Tag;
use App\Models\Team;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function home () {
        $user = auth('sanctum')->user();
        $notificationCount = Auth::User()->unreadNotifications()->count();
        $notification = Auth::User()->Notifications;
        return response()->json([
            'user' => $user,
            'notificationCount' => $notificationCount,
            'notification' => $notification,
        ]);
    }
    public function getMyTeam()
    {
        $id = Auth::user()->id;
        $settings = Setting::first();
        $users = User::users()->doesntHave('member')->where('id', '!=', $id)->get();
        $tags = Tag::active()->get();
        $authUser = User::find($id);
        $supervisors = User::supervisors()->doesntHave('supervisorTeams')->orwhereHas('supervisorTeams', function($q){
            $q->where('status', Team::STATUS_APPROVED);
            $q->orWhere('status', Team::STATUS_NOT_APPROVED);
        }, '<', $settings?->max_group_teacher)->supervisors()->get();

        return response()->json([
            'settings' => $settings,
            'users' => $users,
            'tags' => $tags,
            'authUser' => $authUser,
            'supervisors' => $supervisors], 200);
    }
}
