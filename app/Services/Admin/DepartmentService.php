<?php

namespace App\Services\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;


class DepartmentService
{
    public function checkRequestType($request)
    {
        return $request->expectsJson() ? 'api' : 'web';
    }

    public function index()
    {
        $active = Department::active()->count();
        $Inactive= Department::inActive()->count();
        return [
            'active' => $active,
            'Inactive' => $Inactive,
        ];
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name',
            'status'=>'sometimes',
        ]);

        $input = $request->all();

        if (isset($request->status)) {
            $input['status'] = Department::STATUS_ACTIVE;
        } else {
            $input['status'] = Department::STATUS_INACTIVE;
        }
        $department = Department::create($input);

        Alert::success('Successfully', 'Department Created Successfully');
        return $department;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::where('id', $id)->firstOrFail();
        return $department;
    }

    public function update(Request $request, string $id)
    {
        $$request->validate([
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
        return $department;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();
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
