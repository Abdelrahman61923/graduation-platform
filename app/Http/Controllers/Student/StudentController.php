<?php

namespace App\Http\Controllers\Student;

use App\Models\Tag;
use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;

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
