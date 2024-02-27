<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use RealRashid\SweetAlert\Facades\Alert;
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
        return view('admins.tags.index', compact('active', 'Inactive'));
    }

    public function getTags()
    {
        $tags = Tag::select('*');
        $builder = DataTables::of($tags)
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tag = new Tag();
        return view('admins.tags.create', compact('tag'));
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
        Tag::create($input);

        Alert::success('Successfully', 'Tag Created Successfully');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::where('id', $id)->firstOrFail();
        return view('admins.tags.edit', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::where('id', $id)->firstOrFail();
        return view('admins.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name,'.$id,
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

        Alert::success('Successfully', 'Tag Updated Successfully');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            return response()->json(
                [
                    'status' => 1,
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 0,
                ]
            );
        }
    }

    public function changeStatus($id)
    {
        $tag = Tag::findOrFail($id);
        if ($tag->status == Tag::STATUS_INACTIVE) {
            $tag->status = Tag::STATUS_ACTIVE;
            $tag->save();
            $output = array(
                'success' => 'Status changed to Active',
            );
            echo json_encode($output);
        } else {
            $tag->status = Tag::STATUS_INACTIVE;
            $tag->save();
            $output = array(
                'success' => 'Status changed to Deactive',
            );
            echo json_encode($output);
        }
    }
}
