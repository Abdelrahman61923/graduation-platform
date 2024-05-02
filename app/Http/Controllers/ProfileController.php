<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $departments = Department::active()->get();
        return view('profile', compact('departments'));
    }

    public function updateProfile (Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->department_id = $request->department_id;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('assets/upload/student_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('assets/upload/student_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();

        Alert::success('successfully', 'Student Profile Update Successfuly');
        return back();
    }
}
