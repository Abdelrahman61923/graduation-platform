<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active = Department::active()->count();
        $Inactive= Department::inActive()->count();
        return view('admins.departments.index', compact('active', 'Inactive'));
    }

    public function getDepartments()
    {
        $departments = Department::select('*');
        $builder = DataTables::of($departments)
            ->addColumn('name', function ($data) {
                return $data->name;
            })->addColumn('status', function ($data) {
                return $data->status;
            })->filterColumn('name', function ($query, $keyword) {
                return $query->whereRaw("name like ?", ["%{$keyword}%"]);
            })->filterColumn('status', function ($query, $keyword) {
                return $query->whereRaw("status like ?", ["%{$keyword}%"]);
            })->make(true);

        return $builder;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = new Department();
        return view('admins.departments.create', compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments,name',
            'status'=>'sometimes',
        ]);

        $input = $request->all();

        if (isset($request->status)) {
            $input['status'] = Department::STATUS_ACTIVE;
        } else {
            $input['status'] = Department::STATUS_INACTIVE;
        }
        Department::create($input);

        Alert::success('Successfully', 'Department Created Successfully');
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::where('id', $id)->firstOrFail();
        return view('admins.departments.edit', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::where('id', $id)->firstOrFail();
        return view('admins.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:departments,name,'.$id,
            'status'=>'sometimes',
        ]);

        $department = Department::where('id', $id)->firstOrFail();

        $input = $request->all();

        if (isset($request->status)) {
            $input['status'] = Department::STATUS_ACTIVE;
        } else {
            $input['status'] = Department::STATUS_INACTIVE;
        }
        $department->update($input);

        Alert::success('Successfully', 'Department Updated Successfully');
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();
        // if ($department) {
        //     $department->delete();
        //     return response()->json(
        //         [
        //             'status' => 1,
        //         ]
        //     );
        // } else {
        //     return response()->json(
        //         [
        //             'status' => 0,
        //         ]
        //     );
        // }
    }

    public function changeStatus($id)
    {
        $department = Department::findOrFail($id);
        if ($department->status == Department::STATUS_INACTIVE) {
            $department->status = Department::STATUS_ACTIVE;
            $department->save();
            $output = array(
                'success' => 'Status changed to Active',
            );
            echo json_encode($output);
        } else {
            $department->status = Department::STATUS_INACTIVE;
            $department->save();
            $output = array(
                'success' => 'Status changed to Deactive',
            );
            echo json_encode($output);
        }
    }
}
