<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\AppController;
use App\Models\Group;
use App\Traits\ActionWithFileTraits;

class GroupController extends AppController
{
    use ActionWithFileTraits;

    public function getAll()
    {
        return response()->json([
            'groups' => Group::orderBy('rating', 'asc')->get(),
        ]);
    }

    public function save(Request $request)
    {
        $messages = [
            'unique' => 'Имя "' . $request->input('name') . '" уже существует.',
        ];
        $this->validate($request, [
            'name' => 'unique:groups'
        ], $messages);

        $imageName = str_random(15)  . '.' . $request->input('img');


        $insert = [
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
            'img' => $imageName,
            'rating' => $request->input('rating'),
            'active' => $request->input('active'),
        ];
        
        $id = Group::insertGetId($insert);

        return response()->json([
            'id' => $id,
            'imageName' => $imageName
        ]);
    }

    public function uploadImg(Request $request)
    {
        $id = $request->input('id');
        $imageName = $request->input('imageName');
        $path = $this->createPath('groups', $id);

        $this->uploadFile($request, $path, $imageName);

        return response()->json([
            'id' => $id,
            'imageName' => $imageName
        ]);
    }

    public function deleteGroups($id)
    {

        $group = Group::where('id', $id);
        $groupInfo = $group->first();
        $imgPath = $this->createPath('groups', $id) . '/' . $groupInfo->img;


        $this->deleteFile($imgPath);
        $this->deleteDirectory($this->createPath('groups', $id));
        $group->delete();

        return response()->json([
            'info' => $imgPath
        ]);
    }

    public function updateGroups(Request $request, $id)
    {

        $imgNew = $request->input('img');
        $imgOld = Group::select('img')->where('id', '=', $id)->first()->img;
        $imageName = false;

        $update = [
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'active' => $request->input('active') == 'true' ? 1 : 0,
        ];

        if ($imgNew) {
            $imgPath = $this->createPath('groups', $id) . '/' . $imgOld;
            $imageName = str_random(15) . '.' . $imgNew;
            $update = array_add($update, 'img', $imageName);

            $this->deleteFile($imgPath);
        }

        Group::where('id', $id)->update($update);

        return response()->json([
            'id' => $id,
            'imageName' => $imageName,
            'update' => $update,
        ]);
    }
}
