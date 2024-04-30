<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Tag;
use App\Models\Team;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MemberResource;

class StudentController extends Controller
{
    public function home () {
        $user = auth('sanctum')->user();
        $notificationCount = Auth::User()->unreadNotifications()->count();
        $notification = Auth::User()->Notifications;
        return response()->json([
            'user' => $user,
            'notificationCount' => $notificationCount,
            // 'notification' => $notification,
        ], 200);
    }
    public function getMyTeam()
    {
        $id = Auth::user()->id;
        $authUser = User::find($id);
        $team = $authUser->team;
        $members = $authUser->team->members;

        if ($authUser->team) {
            $team = new TeamResource($team);
            $members = MemberResource::collection($members);
            return response()->json([
                'team' => $team,
                'members' => $members,
            ], 200);
        }
        else {
            $settings = Setting::first();
            $users = User::users()->doesntHave('member')->where('id', '!=', $id)->get();
            $tags = Tag::active()->get();
            $supervisors = User::supervisors()->doesntHave('supervisorTeams')->orwhereHas('supervisorTeams', function($q){
            $q->where('status', Team::STATUS_APPROVED);
            $q->orWhere('status', Team::STATUS_NOT_APPROVED);
            }, '<', $settings?->max_group_teacher)->supervisors()->get();

            return response()->json([
                'settings' => $settings,
                'users' => $users,
                'tags' => $tags,
                'authUser' => $authUser,
                'supervisors' => $supervisors
            ], 200);
        }
    }
}
