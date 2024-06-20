<?php

namespace App\Services\Admin;

use App\Models\Instruction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class InstructionService
{
    public function checkRequestType($request)
    {
        return $request->expectsJson() ? 'api' : 'web';
    }

    public function index()
    {
        $create_teams = Instruction::team()->get();
        $projects1 = Instruction::project1()->get();
        $projects2 = Instruction::project2()->get();
        return [
            'create_teams' => $create_teams,
            'projects1' => $projects1,
            'projects2' => $projects2,
        ];
    }
    public function create()
    {
        $instruction = new Instruction();
        $types = [
            ['id' => Instruction::TYPE_CREATE_NEW_TEAM, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_CREATE_NEW_TEAM)))],
            ['id' => Instruction::TYPE_PROJECT1, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT1)))],
            ['id' => Instruction::TYPE_PROJECT2, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT2)))],
        ];
        return [
            'instruction' => $instruction,
            'types' => $types,
        ];
    }
    public function store(Request $request)
    {
        $request->validate([
            'instruction' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in(Instruction::types())],
        ]);

        $input = $request->all();

        $Instruction = Instruction::create($input);

        Alert::success('Successfully', 'Instructions Created Successfully');

        return $Instruction;
    }
    public function edit(string $id)
    {
        $instruction = Instruction::where('id', $id)->firstOrFail();
        $types = [
            ['id' => Instruction::TYPE_CREATE_NEW_TEAM, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_CREATE_NEW_TEAM)))],
            ['id' => Instruction::TYPE_PROJECT1, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT1)))],
            ['id' => Instruction::TYPE_PROJECT2, 'name' => Str::title(str_replace('-', ' ', str_replace('_', ' ', Instruction::TYPE_PROJECT2)))],
        ];
        return [
            'instruction' => $instruction,
            'types' => $types,
        ];
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'instruction' => ['required', 'string'],
            'type' => ['required', 'string', Rule::in(Instruction::types())],
        ]);

        $instruction = Instruction::where('id', $id)->firstOrFail();

        $input = $request->all();

        $instruction->update($input);

        Alert::success('Successfully', 'Instruction Updated Successfully');

        return $instruction;
    }
}
