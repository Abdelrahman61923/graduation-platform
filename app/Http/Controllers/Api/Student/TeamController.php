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
use App\Notifications\InvitationTeamNotification;
use Illuminate\Support\Facades\Notification;

class TeamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_title' => ['required', 'string', 'max:255'],
            'project_description' => ['required', 'string'],
            'member_ids' => ['required', 'array', 'min:1'],
            'tag_ids' => ['required', 'array', 'min:1'],
        ]);
        $settings = Setting::first();
        if (count($request->member_ids) > $settings->max_team_member) {
            return response()->json(['message' => 'Team members should be less than max team member setting'], 200);
        }

        DB::transaction(function () use ($request) {
            $membersData = [];
            $user = Auth::user();
            $lastTeam = Team::latest()->first();

            $currentYear = date('Y');
            $team_number = ''.$lastTeam?($currentYear.''.$lastTeam->id+1).'':$currentYear.'1';

            $data = [
                'leader_id' => $user->id,
                'team_number' => $team_number,
            ];

            $team = Team::create(array_merge($request->except(['member_ids', 'tag_ids']), $data));

            $team->tags()->sync($request->tag_ids);

            $leaderMember = new Member();
            $leaderMember->team_id = $team->id;
            $leaderMember->member_id = $user->id;
            $leaderMember->is_leader = true;
            $leaderMember->status = Member::STATUS_ACCEPTED;
            $membersData [] = $leaderMember;

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

        });

        return response()->json([
            'message' => 'Team Created Succeffuly',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_title' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $team = Team::where('id', $id)->firstOrFail();

        DB::transaction(function () use ($request, $team) {
            $team->update($request->except('_token'));
        });

        return response()->json([
            'message' => 'Team Updated Successfuly',
            'team' => $team,
        ], 201);
    }

    public function addSupervisorTeam(Request $request, $id)
    {
        $request->validate([
            'supervisor_id' => ['required', 'numeric', 'exists:users,id'],
        ]);

        $team = Team::where('id', $id)->firstOrFail();

        DB::transaction(function () use ($request, $team) {
            $team->update($request->except('_token'));
        });

        $user = Auth::user();
        $userToNotify = User::findOrFail($request->supervisor_id);
        $user_create = $user->name;

        Notification::send($userToNotify, new InvitationTeamNotification($user_create));

        return response()->json([
            'message' => 'Supervisor Added Successfuly',
            'team' => $team,
        ], 200);
    }

    public function delete($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->delete();
        return response()->json([
            'message' => 'Team Deleted Successfuly',
        ], 200);
    }

    public function deleteSupervisor($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->update(['supervisor_id' => null]);
        return response()->json([
            'message' => 'Supervisor Deleted Successfuly'
        ], 200);
    }
}
