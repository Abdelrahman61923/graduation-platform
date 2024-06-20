<?php

namespace App\Http\Controllers\Admin;

use App\Models\Instruction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Services\Admin\InstructionService;

class InstructionController extends Controller
{

    protected $instructionService;

    public function __construct(InstructionService $instructionService)
    {
        $this->instructionService = $instructionService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requestType = $this->instructionService->checkRequestType($request);
        $Instructions = $this->instructionService->index();

        if ($requestType == 'api') {
            return response()->json([
                'Instructions' => $Instructions,
            ], 200);
        } else {
            return view('admins.Instructions.index', $Instructions);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $requestType = $this->instructionService->checkRequestType($request);
        $Instructions = $this->instructionService->create();

        if ($requestType == 'api') {
            return response()->json([
                'types' => $Instructions['types'],
            ], 200);
        } else {
            return view('admins.Instructions.create', $Instructions);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestType = $this->instructionService->checkRequestType($request);
        $storeinstruction = $this->instructionService->store($request);

        if ($requestType == 'api') {
            return response()->json([
                'message' => 'Instructions Created Successfully',
                'instruction' => $storeinstruction,
            ], 200);
        } else {
            return redirect()->route('instructions.index');
        }

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
    public function edit(Request $request, string $id)
    {
        $requestType = $this->instructionService->checkRequestType($request);
        $Instructions = $this->instructionService->edit($id);

        if ($requestType == 'api') {
            return response()->json([
                'instruction' => $Instructions['instruction'],
                'types' => $Instructions['types'],
            ], 200);
        } else {
            return view('admins.Instructions.edit', $Instructions);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestType = $this->instructionService->checkRequestType($request);
        $updateinstruction = $this->instructionService->update($request, $id);

        if ($requestType == 'api') {
            return response()->json([
                'message' => 'Instruction Updated Successfully',
                'instruction' => $updateinstruction,
            ], 200);
        } else {
            return redirect()->route('instructions.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $requestType = $this->instructionService->checkRequestType($request);

        $instruction = Instruction::find($id);

        if ($requestType == 'api') {
            $instruction->delete();
            return response()->json([
                'message' => 'Instruction Delete Successfully',
            ], 200);
        } else {
            $instruction->delete();
        }
    }
}
