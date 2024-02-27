<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Setting;
use App\Models\Team;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function home()
    {
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
        if ($number_of_members_in_teams_precantage > 0) {
            $total_student_precantage = ($number_of_members_in_teams * $total_users) / 100;
        }
        return view('admins.home', compact('total_supervisor', 'total_students',
                                            'total_supervisor_precantage', 'total_student_precantage',
                                            'total_teams', 'number_of_members_in_teams', 'number_of_members_in_teams_precantage'));
    }

    public function settings()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();
        } 
        return view('admins.settings.index', compact('setting'));
    }

    public function storeSettings(Request $request)
    {
        $this->validate($request, [
            'min_team_member' => 'required|numeric',
            'max_team_member' => 'required|numeric',
            'max_group_teacher' => 'required|numeric',
        ]);

        Setting::updateOrCreate(['id' => $request->id], $request->all());

        Alert::success('Successfully', 'Settings Updated Successfully');
        return redirect()->route('admins.settings');
    }
}
