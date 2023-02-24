<?php

namespace App\Http\Controllers;

use App\Models\movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return movies::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        $movie = new movies();
        $movie->judul = $request->judul;
        $movie->tanggal = $request->tanggal;
        $movie->genre = $request->genre;
        $movie->sinopsis = $request->sinopsis;
        $movie->save();

        return "Data berhasil ditambahkan";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function show(movies $movies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function edit(movies $movies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $judul = $request->judul;
        $tanggal = $request->tanggal;
        $genre = $request->genre;
        $sinopsis = $request->sinopsis;

        $movie = movies::find($id);
        $movie->judul = $judul;
        $movie->tanggal = $tanggal;
        $movie->genre = $genre;
        $movie->sinopsis = $sinopsis;
        $movie->save();

        return "Data berhasil diupdate";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\movies  $movies
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $movie = movies::find($id);
        $movie->delete();

        return "Data berhasil dihapus";
    }
}
