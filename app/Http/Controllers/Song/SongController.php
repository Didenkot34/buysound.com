<?php

namespace App\Http\Controllers\Song;

use App\Http\Controllers\AppController;
use App\Models\Song;
use App\Traits\ActionWithFileTraits;
use Illuminate\Http\Request;

class SongController extends AppController
{
    use ActionWithFileTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'songs' => Song::getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $messages = [
//            'unique' => 'Имя "' . $request->input('name') . '" уже существует.',
//        ];
//        $this->validate($request, [
//            'name' => 'unique:groups'
//        ], $messages);

        $dataToSave = $this->getDataToSave($request);

        $id = Song::insertGetId($dataToSave);

        return response()->json([
            'id' => $id,
            'imgName' => $dataToSave['img'] ?? false,
            'audioName' => $dataToSave['audio'] ?? false,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $imgExtension = $request->input('img');
        $audioExtension = $request->input('audio');

        $oldImgName = Song::select('img')->where('id', '=', $id)->first()->img;
        $oldAudioName = Song::select('audio')->where('id', '=', $id)->first()->audio;

        $dataToSave = $this->getDataToSave($request, $id);

        if ($imgExtension) {
            $pathToImg = $this->createPath('songs', $id) . '/' . $oldImgName;
            $this->deleteFile($pathToImg);
        }
        if ($audioExtension) {
            $pathToAudio = $this->createAudioPath($id) . '/' . $oldAudioName;
            $this->deleteFile($pathToAudio);
        }

        Song::where('id', $id)->update($dataToSave);

        return response()->json([
            'id' => $id,
            'imgName' => $dataToSave['img'] ?? 0,
            'audioName' => $dataToSave['audio'] ?? 0,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = Song::where('id', $id);
        $songInfo = $song->first();
        $pathToImg = $this->createPath('songs', $id) . '/' . $songInfo->img;
        $pathToAudio = $this->createAudioPath($id) . '/' . $songInfo->img;


        $this->deleteFile($pathToImg);
        $this->deleteFile($pathToAudio);
        $this->deleteDirectory($this->createPath('songs', $id));
        $this->deleteDirectory($this->createAudioPath($id));
        $song->delete();

        return response()->json([
            'info' => $pathToImg
        ]);
    }

    public function uploadFiles(Request $request)
    {
        $id = $request->input('id');
        
        $imgName = $request->input('imgName');
        $audioName = $request->input('audioName');

        $pathToImg = $this->createPath('songs', $id);
        $pathToAudio = $this->createAudioPath($id);

        $this->uploadFile($request, $pathToImg, $imgName, 'img');
        $this->uploadFile($request, $pathToAudio, $audioName, 'audio');

        return response()->json([
            'id' => $id,
            'imgName' => $imgName,
            'audioName' => $audioName,
        ]);
    }

    private function getDataToSave(Request $request, $songId = null)
    {
        $imgExtension = $request->input('img');
        $audioExtension = $request->input('audio');
        $imgName = $imgExtension ? str_random(15) . '.' . $imgExtension : false;
        $audioName = $audioExtension ? str_random(15) . '.' . $audioExtension : false;

        $dataToSave = [
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'active' => $request->input('active') == 'true' ? 1 : 0,
            'price' => 100,
            'sale' => 50,
        ];

        if (($songId === null && $imgExtension) || ($songId !== null && $imgExtension)) {

            $dataToSave = array_add($dataToSave, 'img', $imgName);
        }
        if (($songId === null && $audioExtension) || ($songId !== null && $audioExtension)) {

            $dataToSave = array_add($dataToSave, 'audio', $audioName);
        }

        return $dataToSave;
    }
}
