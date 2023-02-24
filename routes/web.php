<?php

use App\Models\live;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('movie/index');
    // $client = Http::get('http://localhost:8000/api/movies');
    // $data= $client->body();

    // $client = Http::get('http://www.omdbapi.com/?apikey=2121c6c&s=boss baby');
    // dd($client);
});
Route::get('/search', function () {
    return view('movie/search');
});
Route::get('/input', function () {
    $live = live::all();
    return view('movie/input', ['live' => $live]);
});
Route::get('/lives', function () {
    return view('lives/index');
});
Route::get('/inputlives', function () {
    return view ('lives/input');
});