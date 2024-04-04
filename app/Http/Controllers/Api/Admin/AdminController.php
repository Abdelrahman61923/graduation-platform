<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function home()
    {
        $user = auth('sanctum')->user();
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
        return response()->json([
            'total_supervisor' => $total_supervisor,
            'total_students'   => $total_students,
            'total_supervisor_precantage' => $total_supervisor_precantage,
            'total_student_precantage' => $total_student_precantage,
            'total_teams' => $total_teams,
            'number_of_members_in_teams' => $number_of_members_in_teams,
            'number_of_members_in_teams_precantage' => $number_of_members_in_teams_precantage,
            'user' => $user,
        ], 200);
    }

    public function settings()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        }
        return response()->json([
            'setting' => $setting,
        ]);
    }

    public function storeSettings(Request $request)
    {
        $this->validate($request, [
            'min_team_member' => 'required|numeric',
            'max_team_member' => 'required|numeric',
            'max_group_teacher' => 'required|numeric',
        ]);

        $setting = Setting::updateOrCreate(['id' => $request->id], $request->all());

        return response()->json([
            'message' => 'Settings Updated Successfully',
            'setting' => $setting,
        ], 200);
    }
}
