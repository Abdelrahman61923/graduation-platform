<?php

namespace App\Http\Controllers\Student;

use App\Models\Tag;
use App\Models\Team;
use App\Models\User;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Instruction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    public function getInstructions ()
    {
        $user = Auth::user();
        $create_teams = Instruction::team()->get();
        $projects1 = Instruction::project1()->get();
        $projects2 = Instruction::project2()->get();
        return view('students.instruction.index', compact('user' ,'create_teams', 'projects1', 'projects2'));
    }

    public function getProjects ()
    {
        $projects = Project::all();
        return view('students.project.index', compact('projects'));
    }
}
