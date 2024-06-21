<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'first_name'           => $row[0],
            'last_name'            => $row[1],
            'username'             => $row[2],
            'email'                => $row[3],
            'is_change_password'   => $row[4],
            'password' => Hash::make($row[5]),
            'student_id'           => $row[6],
            'phone'                => $row[7],
            'role'                 => $row[8],
            'created_at'           => $row[9],
            'updated_at'           => $row[10],
        ]);
    }
}
