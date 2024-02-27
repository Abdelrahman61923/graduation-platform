<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SupervisorController extends Controller
{
    public function home()
    {
        return view('supervisors.home');
    }

    public function getMyTeams()
    {
        return view('supervisors.my-teams.index');
    }

    public function getTeams()
    {
        $authUser = User::find(Auth::user()->id);
        if ($authUser->role == User::ROLE_SUPERVISOR) {
            $teams = $authUser->supervisorTeams()->select('*');
        } else {
            $teams = Team::select('*');
        }
        $builder = DataTables::of($teams)
            ->addColumn('team_number', function ($data) {
                return $data->team_number;
            })->addColumn('project_title', function ($data) {
                return $data->project_title;
            })->addColumn('project_description', function ($data) {
                return ($this->str_limit(strip_tags($data->project_description), $limit = 30, $end = '...'));
            })->addColumn('status', function ($data) {
                return $data->status;
            })->addColumn('leader', function ($data) {
                return $data->leader->full_name;
            })->filterColumn('leader', function ($query, $keyword) {
                $query->whereHas('leader', function ($q) use ($keyword) {
                    return $q->whereRaw("concat(users.first_name,' ' , users.last_name) like ?", ["%{$keyword}%"]);
                });
            })->make(true);

        return $builder;
        
    }

    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }

    public function getTeamMembers($team_id)
    {
        $team = Team::where('id', $team_id)->firstOrFail();
        $members = $team->members()->select('*');
        $builder = DataTables::of($members)
            ->addColumn('full_name', function ($data) {
                return $data->user->full_name;
            })->addColumn('username', function ($data) {
                return $data->user->username;
            })->addColumn('student_id', function ($data) {
                return $data->user->student_id;
            })->addColumn('email', function ($data) {
                return $data->user->email;
            })->addColumn('photo', function ($data) {
                return $data->user->photo;
            })
            ->filterColumn('full_name', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    return $q->whereRaw("concat(users.first_name,' ' , users.last_name) like ?", ["%{$keyword}%"]);
                });
            })
            ->filterColumn('student_id', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    return $q->whereRaw("users.student_id like ?", ["%{$keyword}%"]);
                });
            })
            ->filterColumn('username', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    return $q->whereRaw("users.username like ?", ["%{$keyword}%"]);
                });
            })
            ->filterColumn('email', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    return $q->whereRaw("users.email like ?", ["%{$keyword}%"]);
                });
            })
            ->make(true);
        return $builder;
    }

    public function approveTeam($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->update(['status' => Team::STATUS_APPROVED]);
        Alert::success('successfully', 'Team Approved Successfuly');
        return back();
    }

    public function rejectTeam($id)
    {
        $team = Team::where('id', $id)->firstOrFail();
        $team->update(['status' => Team::STATUS_NOT_APPROVED, 'supervisor_id' => null]);
        Alert::success('successfully', 'Team Rejected Successfuly');
        return redirect()->route('supervisors.teams');
    }
}
