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

        $dataToSave = $this->getDataToSave($request);
        
        $id = Group::insertGetId($dataToSave);

        return response()->json([
            'id' => $id,
            'imageName' => $dataToSave['img'] ?? false,
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
        $dataToSave = $this->getDataToSave($request, $id);

        if ($imgNew) {
            $imgPath = $this->createPath('groups', $id) . '/' . $imgOld;
            $this->deleteFile($imgPath);
        }

        Group::where('id', $id)->update($dataToSave);

        return response()->json([
            'id' => $id,
            'imageName' => $dataToSave['img'] ?? false,
            'update' => $dataToSave,
        ]);
    }

    private function getDataToSave(Request $request, $groupId = null)
    {
        $imgExtension = $request->input('img');
        $imageName = str_random(15)  . '.' . $imgExtension;

        $dataToSave = [
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'active' => $request->input('active') == 'true' ? 1 : 0,
        ];

        if ( ($groupId === null && $imgExtension) || ($groupId !== null && $imgExtension) ) {

            $dataToSave = array_add($dataToSave, 'img', $imageName);
        }
        
        return $dataToSave;
    }
}
