<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'first_name'=> 'Admin',
                'last_name' => 'Admin',
                'username'  => 'admin',
                'email'     => 'admin@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> null,
                'phone'     => '01075563321',
                'role'      => User::ROLE_ADMIN,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            // Doctor
            [
                'first_name'=> 'Supervisor',
                'last_name' => 'Supervisor',
                'username'  => 'supervisor',
                'email'     => 'supervisor@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> null,
                'phone'     => '01068897742',
                'role'      => User::ROLE_SUPERVISOR,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            // User
            [
                'first_name'=> 'User',
                'last_name' => 'User',
                'username'  => 'user',
                'email'     => 'user@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240331',
                'phone'     => '01096653381',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'first_name'=> 'User2',
                'last_name' => 'User2',
                'username'  => 'user2',
                'email'     => 'user2@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240332',
                'phone'     => '01096653382',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'first_name'=> 'User3',
                'last_name' => 'User3',
                'username'  => 'user3',
                'email'     => 'user3@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240333',
                'phone'     => '01096653383',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'first_name'=> 'User4',
                'last_name' => 'User4',
                'username'  => 'user4',
                'email'     => 'user4@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240334',
                'phone'     => '01096653384',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'first_name'=> 'User5',
                'last_name' => 'User5',
                'username'  => 'user5',
                'email'     => 'user5@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240335',
                'phone'     => '01096653385',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'first_name'=> 'User6',
                'last_name' => 'User6',
                'username'  => 'user6',
                'email'     => 'user6@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240336',
                'phone'     => '01096653386',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'first_name'=> 'User7',
                'last_name' => 'User7',
                'username'  => 'user7',
                'email'     => 'user7@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240337',
                'phone'     => '01096653387',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'first_name'=> 'User8',
                'last_name' => 'User8',
                'username'  => 'user8',
                'email'     => 'user8@gmail.com',
                'is_change_password'=> 1,
                'password'  => Hash::make('12345678'),
                'student_id'=> '20240338',
                'phone'     => '01096653388',
                'role'      => User::ROLE_USER,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
