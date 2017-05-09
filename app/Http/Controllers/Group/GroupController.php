<?php

namespace App\Http\Controllers\Group;

use App\Pattern\Strategy\FileActions\GroupFile;
use App\Pattern\Strategy\FileActions\ImgFileActionsStrategy;
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
            'imgName' => $dataToSave['img'] ?? false,
        ]);
    }

    public function uploadImg(Request $request)
    {
        $id = $request->input('id');
        $imgName = $request->input('imgName');
        $groupFile = new GroupFile('uploads/groups/img/' . $id, new ImgFileActionsStrategy(), $request);
        $groupFile->upload();

        return response()->json([
            'id' => $id,
            'imgName' => $imgName
        ]);
    }

    public function deleteGroups($id)
    {
        
        $group = Group::where('id', $id);
        $groupFile = new GroupFile('uploads/groups/img/' . $id, new ImgFileActionsStrategy());
        $groupFile->delete();
        $group->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function updateGroups(Request $request, $id)
    {

        $imgExtension = $request->input('img');
        $dataToSave = $this->getDataToSave($request, $id);
        if ($imgExtension) {
            $groupFile = new GroupFile('uploads/groups/img/' . $id, new ImgFileActionsStrategy());
            $groupFile->delete();
        }

        Group::where('id', $id)->update($dataToSave);

        return response()->json([
            'id' => $id,
            'imgName' => $dataToSave['img'] ?? false,
        ]);
    }

    private function getDataToSave(Request $request, $groupId = null)
    {
        $imgExtension = $request->input('img');
        $imgName = str_random(15)  . '.' . $imgExtension;

        $dataToSave = [
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'active' => $request->input('active') == 'true' ? 1 : 0,
        ];

        if ( ($groupId === null && $imgExtension) || ($groupId !== null && $imgExtension) ) {

            $dataToSave = array_add($dataToSave, 'img', $imgName);
        }
        
        return $dataToSave;
    }
}
