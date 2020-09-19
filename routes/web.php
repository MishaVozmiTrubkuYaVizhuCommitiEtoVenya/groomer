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
