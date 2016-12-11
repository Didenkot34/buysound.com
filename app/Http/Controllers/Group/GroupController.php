<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use DB;

class GroupController extends Controller
{
    public function getAll()
    {
        return response()->json([
            'groups' => Group::all(),
        ]);
    }

    public function save(Request $request)
    {
        $insert = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'img' => 'test'
        ];
        $id = Group::insertGetId($insert);

        return response()->json([
            'test' =>   $id
        ]);
    }
}
