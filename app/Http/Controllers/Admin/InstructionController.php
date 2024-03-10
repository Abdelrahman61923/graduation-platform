<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function index() {
        return view('admins.Instructions.index');
    }
}
