<?php

namespace App\Http\Controllers\Song;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Pattern\Strategy\FileActions\AudioFile;
use App\Pattern\Strategy\FileActions\FileStrategy;
use App\Pattern\Strategy\FileActions\ImgFile;
use Illuminate\Http\Request;

class SongController extends Controller
{

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
        $pathToImg = 'uploads/songs/img/' . $id;
        $pathToAudio = 'uploads/songs/audio/' . $id;
        $dataToSave = $this->getDataToSave($request, $id);

        if ($imgExtension) {
            $this->deleteImg($pathToImg);
        }
        if ($audioExtension) {
            $this->deleteAudio($pathToAudio);
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

        $pathToImg = 'uploads/songs/img/' . $id;
        $pathToAudio = 'uploads/songs/audio/' . $id;

        $this->deleteImg($pathToImg);
        $this->deleteAudio($pathToAudio);

        $song->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function uploadFiles(Request $request)
    {
        $id = $request->input('id');
        $pathToImg = 'uploads/songs/img/' . $id;
        $pathToAudio = 'uploads/songs/audio/' . $id;

        $this->uploadImg($pathToImg, $request);
        $this->uploadAudio($pathToAudio, $request);

        return response()->json([
            'id' => $id
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

    private function uploadImg($path, Request $request)
    {
        $songImg = new ImgFile($path, new FileStrategy(), $request);
        $songImg->upload();
    }

    private function uploadAudio($path, Request $request)
    {
        $songAudio = new AudioFile($path, new FileStrategy(), $request);
        $songAudio->upload();
    }

    private function deleteImg($path)
    {
        $songImg = new ImgFile($path, new FileStrategy());
        $songImg->delete();
    }
    private function deleteAudio($path)
    {
        $songImg = new AudioFile($path, new FileStrategy());
        $songImg->delete();
    }
}
