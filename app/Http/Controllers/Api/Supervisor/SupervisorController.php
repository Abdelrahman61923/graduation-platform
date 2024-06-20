<?php

namespace App\Http\Controllers\Api\Supervisor;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SupervisorController extends Controller
{
    public function getTeams(Request $request)
    {
        $authUser = User::find(Auth::user()->id);
        if ($authUser->role == User::ROLE_SUPERVISOR) {
            $teams = $authUser->supervisorTeams()->get();
        } else {
            $teams = Team::get();
        }

        if ($request->has('leader')) {
        $leader = $request->input('leader');
        $teams->whereHas('leader', function ($query) use ($leader) {
                $query->whereRaw("concat(users.first_name, ' ', users.last_name) like ?", ["%{$leader}%"]);
            });
        }
        if ($request->has('supervisor')) {
            $supervisor = $request->input('supervisor');
            $teams->whereHas('supervisor', function ($query) use ($supervisor) {
                $query->whereRaw("concat(users.first_name, ' ', users.last_name) like ?", ["%{$supervisor}%"]);
            });
        }
        if ($request->has('team_number')) {
            $team_number = $request->input('team_number');
            $teams->where('team_number', 'like', '%' . $team_number . '%');
        }
        if ($request->has('project_title')) {
            $project_title = $request->input('project_title');
            $teams->where('project_title', 'like', '%' . $project_title . '%');
        }
        if ($request->has('status')) {
            $status = $request->input('status');
            $teams->where('status', 'like', '%' . $status . '%');
        }

        $teams = TeamResource::collection($teams);

        return response()->json([
            'teams' => $teams,
        ]);
    }

    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }

    public function approveTeam($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->update(['status' => Team::STATUS_APPROVED]);
        return response()->json([
            'message' => 'Team Approved Successfuly',
            'team' => new TeamResource($team),
        ], 200);
    }

    public function rejectTeam($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->update(['status' => Team::STATUS_NOT_APPROVED, 'supervisor_id' => null]);
        return response()->json([
            'message' => 'Team Rejected Successfuly',
        ], 200);
    }
}
