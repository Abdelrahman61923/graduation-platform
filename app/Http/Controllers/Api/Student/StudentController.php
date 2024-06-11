<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Tag;
use App\Models\Team;
use App\Models\User;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MemberResource;

class StudentController extends Controller
{
    public function home () {
        $user = auth('sanctum')->user();
        $user = new UserResource($user);
        $notificationCount = Auth::User()->unreadNotifications()->count();
        $notification = Auth::User()->Notifications;
        return response()->json([
            'user' => $user,
            'notificationCount' => $notificationCount,
            'notification' => $notification,
        ], 200);
    }
    public function getMyTeam()
    {
        $id = Auth::user()->id;
        $authUser = User::find($id);

        if ($authUser->team) {
            $team = $authUser->team;
            $team = new TeamResource($team);
            $members = $authUser->team->members;
            $members = MemberResource::collection($members);
            return response()->json([
                'team' => $team,
                'members' => $members,
            ], 200);
        } else {
            return response()->json([
                'Message' => 'No Team Yet',
            ]);
        }
    }
    public function showUsers ()
    {
        $id = Auth::user()->id;
        $authUser = User::find($id);

        $settings = Setting::first();
        $students = User::users()->doesntHave('member')->where('id', '!=', $id)->get();
        $students = UserResource::collection($students);
        $authUser = new UserResource($authUser);

        $tags = Tag::active()->get();
        $supervisors = User::supervisors()->doesntHave('supervisorTeams')->orwhereHas('supervisorTeams', function($q){
            $q->where('status', Team::STATUS_APPROVED);
            $q->orWhere('status', Team::STATUS_NOT_APPROVED);
            }, '<', $settings?->max_group_teacher)->supervisors()->get();
        $supervisors = UserResource::collection($supervisors);

        return response()->json([
            'settings' => $settings,
            'students' => $students,
            'tags' => $tags,
            'authUser' => $authUser,
            'supervisors' => $supervisors
        ], 200);
    }

    public function getInstructions ()
    {
        $create_teams = Instruction::team()->get();
        $projects1 = Instruction::project1()->get();
        $projects2 = Instruction::project2()->get();
        return response()->json([
            'create_teams' => $create_teams,
            'projects1' => $projects1,
            'projects2' => $projects2,
        ], 200);
    }

    public function getProjects ()
    {
        $projects = Project::all();
        return response()->json([
            'projects' => $projects,
        ], 200);
    }
}
