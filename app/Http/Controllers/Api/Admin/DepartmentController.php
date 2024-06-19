<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return response()->json([
            'active' => $active,
            'inactive' => $Inactive,
        ], 200);
    }

    public function getDepartments(Request $request)
    {
        $departments = Department::select('*');

        if ($request->has('name')) {
            $departments->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('status')) {
            $departments->where('status', 'like', '%' . $request->input('status') . '%');
        }

        $builder = DataTables::of($departments)
            ->addColumn('name', function ($data) {
                return $data->name;
            })->addColumn('status', function ($data) {
                return $data->status;
            })->make(true);

        return $builder;
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
        $department = Department::create($input);

        return response()->json([
            'message' => 'Department Created Successfully',
            'department' => $department,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::where('id', $id)->firstOrFail();
        return response()->json([
            'department' => $department
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|unique:departments,name,'.$id,
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

        return response()->json([
            'message' => 'Department Updated Successfully',
            'department' => $department,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();

        return response()->json([
            'message' => 'Department Deleted Successfully'
        ], 200);
    }

    public function changeStatus($id)
    {
        $department = Department::findOrFail($id);
        if ($department->status == Department::STATUS_INACTIVE) {
            $department->status = Department::STATUS_ACTIVE;
            $department->save();

            return response()->json([
                'message' => 'Status changed to Active',
                'department' => $department,
            ], 200);
        } else {
            $department->status = Department::STATUS_INACTIVE;
            $department->save();
            return response()->json([
                'message' => 'Status changed to Deactive',
                'department' => $department,
            ], 200);
        }
    }
}
