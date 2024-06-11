<?php

namespace App\Http\Controllers\Admin;

use App\Models\Instruction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $create_teams = Instruction::team()->get();
        $projects1 = Instruction::project1()->get();
        $projects2 = Instruction::project2()->get();
        return view('admins.Instructions.index', compact('create_teams', 'projects1', 'projects2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instruction = new Instruction();
        $types = [
            ['id' => Instruction::TYPE_CREATE_NEW_TEAM, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_CREATE_NEW_TEAM)))],
            ['id' => Instruction::TYPE_PROJECT1, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT1)))],
            ['id' => Instruction::TYPE_PROJECT2, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT2)))],
        ];
        return view('admins.Instructions.create', compact('instruction', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'instruction' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in(Instruction::types())],
        ]);

        $input = $request->all();

        Instruction::create($input);

        Alert::success('Successfully', 'Instructions Created Successfully');
        return redirect()->route('instructions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instruction = Instruction::where('id', $id)->firstOrFail();
        return view('admins.Instructions.edit', compact('instruction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $instruction = Instruction::where('id', $id)->firstOrFail();
        $types = [
            ['id' => Instruction::TYPE_CREATE_NEW_TEAM, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_CREATE_NEW_TEAM)))],
            ['id' => Instruction::TYPE_PROJECT1, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT1)))],
            ['id' => Instruction::TYPE_PROJECT2, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT2)))],
        ];
        return view('admins.Instructions.edit', compact('instruction', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'instruction' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in(Instruction::types())],
        ]);

        $instruction = Instruction::where('id', $id)->firstOrFail();

        $input = $request->all();

        $instruction->update($input);

        Alert::success('Successfully', 'Instruction Updated Successfully');
        return redirect()->route('instructions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instruction = Instruction::find($id);
        $instruction->delete();
    }
}
