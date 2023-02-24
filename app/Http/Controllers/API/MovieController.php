<?php

namespace App\Http\Controllers\API;

use App\Models\movies;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Http\Resources\movies as MoviesResource;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class MovieController extends BaseController
{
    public function index(){
        $movies = movies::with('live')->get();
        return $this->sendResponse(MoviesResource::collection($movies), 'Movies displayed');
        // return $this->sendResponse(MoviesResource::collection($movies), 'Movies displayed');
    }
    public function store(Request $request){
        // return $request->file('poster')->store('public/poster');
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'judul' => 'required',
                'tanggal' => 'required',
                'genre' => 'required',
                'sinopsis' => 'required',
                'poster' => 'image|mimes:jpeg,png,jpg,gif,svg|file',
                'id_live' => 'required',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $input['poster'] = $request->file('poster')->store('poster');
        $movies = movies::create($input);
        // return $this->sendResponse(new MoviesResource($movies), 'Movies added');
        return redirect('/');
    }
    public function show($id){
        $movies = movies::find($id);
        if (is_null($movies)) {
            return $this->sendError('Movies does not exist');
        }
        return $this->sendResponse(new MoviesResource($movies), 'Movies displayed');
    }
    public function update(Request $request, movies $movies, $id){
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'judul' => 'required',
                'tanggal' => 'required',
                'genre' => 'required',
                'sinopsis' => 'required',
                // 'poster',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $movies = movies::find($id);
        $movies->judul = $input['judul'];
        $movies->tanggal = $input['tanggal'];
        $movies->genre = $input['genre'];
        $movies->sinopsis = $input['sinopsis'];
        // $movies->poster = $input['poster'];
        $movies->save();
        return $this->sendResponse(new MoviesResource($movies), 'Movies updated');
    }
    public function destroy($id){
        $movies = movies::find($id);
        $movies->delete();

        return "Data berhasil dihapus";
    }
}
