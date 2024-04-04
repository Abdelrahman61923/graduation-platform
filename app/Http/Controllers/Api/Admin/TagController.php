<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $active = Tag::active()->count();
        $Inactive= Tag::inActive()->count();
        return response()->json([
            'active' => $active,
            'inactive' => $Inactive
        ], 200);
    }

    public function getTags(Request $request)
    {
        $tags = Tag::select('*');

        if ($request->has('name')) {
            $tags->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->has('status')) {
            $tags->where('status', 'like', '%' . $request->input('status') . '%');
        }
        $builder = DataTables::of($tags)
            ->addColumn('name', function ($data) {
                return $data->name;
            })->addColumn('status', function ($data) {
                return $data->status;
            })->addColumn('uses', function ($data) {
                return $data->teams->count();
            })->make(true);

        return $builder;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name',
            'status'=>'sometimes',
        ]);

        $input = $request->all();

        if (isset($request->status)) {
            $input['status'] = Tag::STATUS_ACTIVE;
        } else {
            $input['status'] = Tag::STATUS_INACTIVE;
        }
        $tag = Tag::create($input);

        return response()->json([
            'message' => 'Tag Created Successfully',
            'tag' => $tag,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::where('id', $id)->firstOrFail();
        return response()->json([
            'tag' => $tag,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'sometimes|required|unique:tags,name,'.$id,
            'status'=>'sometimes',
        ]);

        $tag = Tag::where('id', $id)->firstOrFail();

        $input = $request->all();

        if (isset($request->status)) {
            $input['status'] = Tag::STATUS_ACTIVE;
        } else {
            $input['status'] = Tag::STATUS_INACTIVE;
        }
        $tag->update($input);

        return response()->json([
            'message' => 'Tag Updated Successfully',
            'tag' => $tag,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return response()->json([
            'message' => 'Tag delete successfully',
        ], 200);
    }

    public function changeStatus($id)
    {
        $tag = Tag::findOrFail($id);
        if ($tag->status == Tag::STATUS_INACTIVE) {
            $tag->status = Tag::STATUS_ACTIVE;
            $tag->save();

            return response()->json([
                'message' => 'Status changed to Active',
                'tags' => $tag,
            ], 200);
        } else {
            $tag->status = Tag::STATUS_INACTIVE;
            $tag->save();

            return response()->json([
                'message' => 'Status changed to Deactive',
                'tags' => $tag,
            ], 200);
        }
    }
}
