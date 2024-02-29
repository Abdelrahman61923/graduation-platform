<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WelcomeOnBoardNotification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::admins()->count();
        $supervisors = User::supervisors()->count();
        $students = User::users()->count();
        return view('admins.users.index', compact('admins', 'supervisors', 'students'));
    }

    public function getUsers()
    {
        $users = User::select('*');
        $builder = DataTables::of($users)
            ->addColumn('photo', function ($data) {
                return $data->photo;
            })->addColumn('full_name', function ($data) {
                return $data->full_name;
            })->addColumn('email', function ($data) {
                return $data->email;
            })->addColumn('role', function ($data) {
                return $data->role;
            })->addColumn('username', function ($data) {
                return $data->username??'--';
            })->addColumn('student_id', function ($data) {
                return $data->student_id??'--';
            })->addColumn('department', function ($data) {
                return $data->department?->name??'--';
            })->addColumn('phone', function ($data) {
                return $data->phone;
            })->addColumn('in_group', function($data){
                return $data->member? 'Yes' : 'No';
            })->filterColumn('full_name', function ($query, $keyword) {
                return $query->whereRaw("concat(users.first_name,' ' , users.last_name) like ?", ["%{$keyword}%"]);
            })->filterColumn('email', function ($query, $keyword) {
                return $query->whereRaw("email like ?", ["%{$keyword}%"]);
            })->filterColumn('phone', function ($query, $keyword) {
                return $query->whereRaw("phone like ?", ["%{$keyword}%"]);
            })->filterColumn('username', function ($query, $keyword) {
                return $query->whereRaw("username like ?", ["%{$keyword}%"]);
            })->filterColumn('student_id', function ($query, $keyword) {
                return $query->whereRaw("student_id like ?", ["%{$keyword}%"]);
            })->filterColumn('role', function ($query, $keyword) {
                return $query->whereRaw("role like ?", ["%{$keyword}%"]);

            })->filterColumn('in_group', function ($query, $keyword) {
                $query->whereHas('member', function ($q) use ($keyword){
                    return $q->whereRaw("(CASE WHEN members.member_id = 1 THEN 'yes' ELSE 'no' END) like ?", ["%{$keyword}%"]);
                });

            })->filterColumn('department', function ($query, $keyword) {
                $query->whereHas('department', function ($q) use ($keyword) {
                    return $q->whereRaw("departments.name like ?", ["%{$keyword}%"]);
                });
            })->make(true);

        return $builder;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $departments = Department::active()->get();
        $roles = [
            ['id' => User::ROLE_ADMIN, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', User::ROLE_ADMIN)))],
            ['id' => User::ROLE_SUPERVISOR, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', User::ROLE_SUPERVISOR)))],
            ['id' => User::ROLE_USER, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', User::ROLE_USER)))],
        ];
        return view('admins.users.create', compact('user', 'departments', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'role' => ['required', 'string', Rule::in(User::roles())],
            'department_id' => [Rule::requiredIf($request->get('role') != User::ROLE_ADMIN), 'numeric'],
        ]);

        $input = $request->all();

        $password = $this->generateRandomString();

        $input['password'] = $password;
        // $input['is_change_password'] = 1;

        $user = User::create($input);

        if ($request->role == User::ROLE_USER) {
            $currentYear = date('Y');
            $student_id = ''.$currentYear.''.$user->id;
            $username = ''.$user->first_name.''.$user->last_name.''.$user->id;
            $user->student_id = $student_id;
            $user->username = $username;
            $user->save();
        }

        Notification::send($user, new WelcomeOnBoardNotification($password));

        Alert::success('Successfully', 'User Created Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('admins.users.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $departments = Department::active()->get();
        $roles = [
            ['id' => User::ROLE_ADMIN, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', User::ROLE_ADMIN)))],
            ['id' => User::ROLE_SUPERVISOR, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', User::ROLE_SUPERVISOR)))],
            ['id' => User::ROLE_USER, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', User::ROLE_USER)))],
        ];
        return view('admins.users.edit', compact('user', 'departments', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'address' => ['sometimes', 'nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($request->route('user'))],
            // 'role' => ['required', 'string', Rule::in(User::roles())],
            // 'department_id' => [Rule::requiredIf($request->get('role') != User::ROLE_ADMIN), 'numeric'],
        ]);

        $user = User::where('id', $id)->firstOrFail();

        $input = $request->all();

        $user->update($input);

        Alert::success('Successfully', 'User Updated Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function generateRandomString($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
