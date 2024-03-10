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
            })->addColumn('supervisor', function ($data) {
                return $data->supervisor->full_name??'--';
            })->addColumn('status', function ($data) {
                return $data->status;
            })->addColumn('leader', function ($data) {
                return $data->leader->full_name;
            })
            ->filterColumn('team_number', function ($query, $keyword) {
                return $query->whereRaw("team_number like ?", ["%{$keyword}%"]);
            })->filterColumn('project_title', function ($query, $keyword) {
                return $query->whereRaw("project_title like ?", ["%{$keyword}%"]);
            })->filterColumn('status', function ($query, $keyword) {
                return $query->whereRaw("status like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('leader', function ($query, $keyword) {
                $query->whereHas('leader', function ($q) use ($keyword) {
                    return $q->whereRaw("concat(users.first_name,' ' , users.last_name) like ?", ["%{$keyword}%"]);
                });
            })
            ->filterColumn('supervisor', function ($query, $keyword) {
                $query->whereHas('supervisor', function ($q) use ($keyword) {
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
            })->addColumn('phone', function ($data) {
                return $data->user->phone;
            })->addColumn('student_id', function ($data) {
                return $data->user->student_id;
            })->addColumn('email', function ($data) {
                return $data->user->email;
            })->addColumn('photo', function ($data) {
                return $data->user->photo;
            })->addColumn('department', function ($data) {
                return $data->user->department->name??'--';
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
            ->filterColumn('department', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->whereHas('department', function ($qu) use ($keyword) {
                        $qu->where('name', 'like', "%{$keyword}%");
                    });
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
        return response()->json([
            'message' => 'Team Approved Successfuly'
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
