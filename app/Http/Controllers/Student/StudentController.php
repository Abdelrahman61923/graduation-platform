<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Team;
use App\Notifications\InvitationTeamNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    public function home()
    {
        return view('students.home');
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

        return view('students.my-team.index', compact('settings', 'users', 'tags', 'authUser', 'supervisors'));
    }
}
