<?php

namespace App\Http\Controllers\Api\Supervisor;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SupervisorController extends Controller
{
    public function getTeams(Request $request)
    {
        $authUser = User::find(Auth::user()->id);
        if ($authUser->role == User::ROLE_SUPERVISOR) {
            $teams = $authUser->supervisorTeams()->select('*');
        } else {
            $teams = Team::select('*');
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

        $builder = DataTables::of($teams)
            ->addColumn('team_number', function ($data) {
                return $data->team_number;
            })->addColumn('project_title', function ($data) {
                return $data->project_title;
            })->addColumn('project_description', function ($data) {
                return ($this->str_limit(strip_tags($data->project_description), $limit = 30, $end = '...'));
            })->addColumn('supervisor', function ($data) {
                return $data->supervisor->full_name??'--';
            })->addColumn('status', function ($data) {
                return $data->status;
            })->addColumn('leader', function ($data) {
                return $data->leader->full_name??'--';
            })->make(true);

        return $builder;
    }

    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }

    public function getTeamMembers(Request $request, $team_id)
    {
        $team = Team::where('id', $team_id)->firstOrFail();
        $members = $team->members()->select('*');

        if ($request->has('full_name')) {
            $full_name = $request->input('full_name');
            $members->whereHas('user', function ($query) use ($full_name) {
                $query->whereRaw("concat(users.first_name, ' ', users.last_name) like ?", ["%{$full_name}%"]);
            });
        }
        if ($request->has('student_id')) {
            $student_id = $request->input('student_id');
            $members->whereHas('user', function ($query) use ($student_id) {
                $query->where('student_id', 'like', "%{$student_id}%");
            });
        }
        if ($request->has('email')) {
            $email = $request->input('email');
            $members->whereHas('user', function ($query) use ($email) {
                $query->where('email', 'like', "%{$email}%");
            });
        }
        if ($request->has('department')) {
            $department = $request->input('department');
            $members->whereHas('user.department', function ($query) use ($department) {
                $query->where('name', 'like', "%{$department}%");
            });
        }

        $builder = DataTables::of($members)
            ->addColumn('full_name', function ($data) {
                return $data->user->full_name??'--';
            })->addColumn('phone', function ($data) {
                return $data->user->phone??'--';
            })->addColumn('student_id', function ($data) {
                return $data->user->student_id??'--';
            })->addColumn('email', function ($data) {
                return $data->user->email??'--';
            })->addColumn('photo', function ($data) {
                return $data->user->photo??'--';
            })->addColumn('department', function ($data) {
                return $data->user->department->name??'--';
            })->make(true);
        return $builder;
    }

    public function approveTeam($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->update(['status' => Team::STATUS_APPROVED]);
        return response()->json([
            'message' => 'Team Approved Successfuly',
            'team' => $team,
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
