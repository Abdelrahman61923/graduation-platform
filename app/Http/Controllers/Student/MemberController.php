<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Setting;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvitationTeamNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    public function delete($id)
    {
        $member = Member::where('id', $id)->firstOrFail();
        $member->delete();
        Alert::success('successfully', 'Member Deleted Successfuly');
        return back();
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'member_ids' => ['required', 'array', 'min:1'],
        ]);

        $team = Team::where('id', $id)->firstOrFail();

        $settings = Setting::first();
        if ((count($request->member_ids) + $team->members()->count()) > $settings->max_team_member) {
            Alert::error('error', 'Team members should be less than max team member setting');
            return back();
        }

        DB::transaction(function () use ($request, $team) {
            $membersData = [];
            $user = Auth::user();
            foreach ($request->member_ids as $id) {
                $member = new Member();
                $member->team_id = $team->id;
                $member->member_id = $id;

                $membersData [] = $member;
            }

            $team->members()->saveMany($membersData);

            $userToNotify = User::findOrFail($request->member_ids);
            $user_create = $user->name;

            Notification::send($userToNotify, new InvitationTeamNotification($user_create));

            // recode this how to send 1000 mail in laravel
            // $members = User::whereIn($request->member_ids);
            // foreach ($members as $member) {
            //     Notification::send($member, new InvitationTeamNotification($user->name));
            // }
        });

        Alert::success('successfully', 'Members Added Successfuly');
        return back();
    }

    public function acceptMember($id)
    {
        $member = Member::where('id', $id)->firstOrFail();
        $member->update(['status' => Member::STATUS_ACCEPTED]);
        Alert::success('successfully', 'Member Accepted Successfuly');
        return back();
    }
}
