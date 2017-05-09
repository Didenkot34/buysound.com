<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Pattern\Strategy\FileActions\FileStrategy;
use App\Pattern\Strategy\FileActions\ImgFile;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
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

        $pathToImg = 'uploads/groups/img/' . $id;
        $this->uploadImage($pathToImg, $request);

        return response()->json([
            'id' => $id,
            'imgName' => $imgName
        ]);
    }

    public function deleteGroups($id)
    {
        
        $group = Group::where('id', $id);
        $pathToImg = 'uploads/groups/img/' . $id;
        $this->deleteImg($pathToImg);
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
            $pathToImg = 'uploads/groups/img/' . $id;
            $this->deleteImg($pathToImg);
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

    public function uploadImage($path, Request $request)
    {
        $img = new ImgFile($path, new FileStrategy(), $request);
        $img->upload();
    }

    public function deleteImg($path)
    {
        $img = new ImgFile($path, new FileStrategy());
        $img->delete();
    }
}
