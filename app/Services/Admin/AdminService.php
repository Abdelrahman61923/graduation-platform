<?php

namespace App\Services\Admin;

use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use RealRashid\SweetAlert\Facades\Alert;

class AdminService
{
    public function checkRequestType($request)
    {
        return $request->expectsJson() ? 'api' : 'web';
    }

    public function home()
    {
        $user = auth()->user();
        $total_users = User::count();
        $total_supervisor = User::supervisors()->count();
        $total_students = User::users()->count();
        $total_supervisor_precantage = 0;
        $total_student_precantage = 0;
        if ($total_supervisor > 0) {
            $total_supervisor_precantage = ($total_supervisor * $total_users) / 100;
        }
        if ($total_students > 0) {
            $total_student_precantage = ($total_students * $total_users) / 100;
        }
        $total_teams = Team::count();
        $number_of_members_in_teams = Member::where('status', Member::STATUS_ACCEPTED)->count();
        $number_of_members_in_teams_precantage = 0;
        if ($number_of_members_in_teams > 0) {
            $number_of_members_in_teams_precantage = ($number_of_members_in_teams * $total_students) / 100;
        }

        return [
            'total_supervisor' => $total_supervisor,
            'total_students' => $total_students,
            'total_supervisor_precantage' => $total_supervisor_precantage,
            'total_student_precantage' => $total_student_precantage,
            'total_teams' => $total_teams,
            'number_of_members_in_teams' => $number_of_members_in_teams,
            'number_of_members_in_teams_precantage' => $number_of_members_in_teams_precantage,
            'user' => new UserResource($user),
        ];
    }
    public function settings()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }
        return [
            'setting' => $setting,
        ];
    }
    public function storeSettings(Request $request)
    {
        $request->validate([
            'min_team_member' => 'required|numeric',
            'max_team_member' => 'required|numeric',
            'max_group_teacher' => 'required|numeric',
        ]);

        $setting = Setting::updateOrCreate(['id' => $request->id], $request->all());

        Alert::success('Successfully', 'Settings Updated Successfully');

        return $setting;
    }
}
