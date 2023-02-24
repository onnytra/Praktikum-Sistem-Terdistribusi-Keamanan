<?php

namespace App\Http\Controllers;

use App\Models\live;
use Illuminate\Http\Request;
use Validator;

class LiveController extends Controller
{
    public function index()
    {
        $live = live::with('movies')->get();
        return response()->json(['data' => $live]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'nama' => 'required',
                'deskripsi' => 'required',
                'lokasi' => 'required',
                'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|file',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $input['poster'] = $request->file('poster')->store('poster');
        $movies = live::create($input);
        // return $this->sendResponse(new MoviesResource($movies), 'Movies added');
        return redirect('/lives');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\live  $live
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lives = live::find($id);
        if (is_null($lives)) {
            return $this->sendError('Movies does not exist');
        }
        return response()->json(['data' => $lives]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\live  $live
     * @return \Illuminate\Http\Response
     */
    public function edit(live $live)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\live  $live
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, live $live, $id)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'nama' => 'required',
                'deskripsi' => 'required',
                'lokasi' => 'required',
                // 'poster',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $movies = live::find($id);
        $movies->nama = $input['nama'];
        $movies->deskripsi = $input['deskripsi'];
        $movies->lokasi = $input['lokasi'];
        // $movies->poster = $input['poster'];
        $movies->save();
        return $this->sendResponse('Movies updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\live  $live
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lives = live::find($id);
        $lives->delete();

        return "Data berhasil dihapus";
    }
}
