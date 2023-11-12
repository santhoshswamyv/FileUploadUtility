<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::any('/', function () {
    return view('project.welcome');
});

Route::any('/cleartemp', [FileController::class, 'clearTemp']);

Route::any('/error404', function () {
    return view('error.error');
});

Route::any('/upload', function () {
    return view('project.uploadfile');
});

Route::any('/upload/store', [FileController::class, 'storeFile']);


Route::any('/search', function () {
    return view('project.searchfile');
});

Route::any('/search/files', [FileController::class, 'searchFile']);

Route::any('/view/{fileName}/{fileCode}', [FileController::class, 'readFile']);

Route::any('/download/{fileName}/{fileCode}', [FileController::class, 'downloadFile']);

Route::any('/delete/{fileName}/{fileCode}', [FileController::class, 'deleteFile']);

Route::any('/download', function () {
    return view('project.downloadfile');
});

Route::any('/download/{type}', [FileController::class, 'download']);