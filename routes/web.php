<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get(
    "/",
    function () {
        return view('api');
    }
);

Route::get(
    "/api-resource/{filename}",
    function ($filename) {
        $pathToFile = base_path("/vendor/swagger-api/swagger-ui/dist/" . $filename);
        $headers = [
            'Content-Type' => \GuzzleHttp\Psr7\mimetype_from_filename($filename)
        ];
        return response()->file($pathToFile, $headers);
    }
)->name('swagger-resource');

Route::get('loaderio-bfc236d49ee42f22d4182fc4d0f299a8', function(){
    return "loaderio-bfc236d49ee42f22d4182fc4d0f299a8";
});


Auth::routes();

Route::get('clients', function(){
    return \App\Models\Swagger\v1\Client::all();
});

Route::get('masters', function(){
    return \App\Models\Swagger\v1\Master::all();
});

