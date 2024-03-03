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
            Alert::error('error', 'Team members should be less than max team member setting');
            return back();
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

            //recode this how to send 1000 mail in laravel
            // $members = User::whereIn($request->member_ids);
            // foreach ($members as $member) {
            //     Notification::send($member, new InvitationTeamNotification($user->name));
            // }
        });

        Alert::success('successfully', 'Team Created Successfuly');
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_title' => ['required', 'string', 'max:255'],
        ]);

        $team = Team::where('id', $id)->firstOrFail();

        DB::transaction(function () use ($request, $team) {
            $team->update($request->except('_token'));
        });

        Alert::success('successfully', 'Team Updated Successfuly');
        return back();
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

        Alert::success('successfully', 'Supervisor Added Successfuly');
        return back();
    }

    public function delete($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->delete();
        Alert::success('successfully', 'Team Deleted Successfuly');
        return back();
    }

    public function deleteSupervisor($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->update(['supervisor_id' => null]);
        Alert::success('successfully', 'Supervisor Deleted Successfuly');
        return back();
    }

    public function show($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        if (auth()->user()->role != User::ROLE_USER) {
            if ($team->supervisor_id != auth()->id() && auth()->user()->role == User::ROLE_SUPERVISOR) {
                return abort(404);
            }
        }
        $settings = Setting::first();
        $users = User::users()->doesntHave('member')->get();
        $members = Member::get();

        $supervisors = User::supervisors()->doesntHave('supervisorTeams')->orwhereHas('supervisorTeams', function($q){
            $q->where('status', Team::STATUS_APPROVED);
            $q->orWhere('status', Team::STATUS_NOT_APPROVED);
        }, '<', $settings?->max_group_teacher)->supervisors()->get();

        return view('supervisors.my-teams.team-info', compact('team', 'supervisors', 'settings', 'users', 'members'));
    }
}
