<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InvitationTeamNotification;

class MemberController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'member_ids' => ['required', 'array', 'min:1'],
        ]);

        $team = Team::where('id', $id)->firstOrFail();

        $settings = Setting::first();
        if ((count($request->member_ids) + $team->members()->count()) > $settings->max_team_member) {
            return response()->json(['message' => 'Team members should be less than max team member setting']);
        }

        DB::transaction(function () use ($request, $team) {
            $membersData = [];
            $user = Auth::user();
            foreach ($request->member_ids as $id) {
                $member = new Member();
                $member->team_id = $team->id;
                $member->member_id = $id;
                if ($user-> role == User::ROLE_ADMIN) {
                    $member->status = Member::STATUS_ACCEPTED;
                }

                $membersData [] = $member;
            }

            $team->members()->saveMany($membersData);

            $userToNotify = User::findOrFail($request->member_ids);
            $user_create = $user->name;

            Notification::send($userToNotify, new InvitationTeamNotification($user_create));

        });
        return response()->json([
            'message' => 'Members Added Successfuly',
        ], 201);

    }

    public function acceptMember($id)
    {
        $member = Member::where('id', $id)->firstOrFail();
        $member->update(['status' => Member::STATUS_ACCEPTED]);
        return response()->json([
            'message' => 'Member Accepted Successfuly'
        ], 200);
    }

    public function delete($id)
    {
        $member = Member::where('id', $id)->firstOrFail();
        $member->delete();
        return response()->json([
            'message' => 'Member Deleted Successfuly'
        ], 200);
    }
}
