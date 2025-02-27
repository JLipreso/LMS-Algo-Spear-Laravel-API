<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'util_command'], function () {
    Route::get('gitPullOrigin', [App\Http\Controllers\util_command\GitCommands::class, 'gitPullOrigin']);
    Route::get('gitRestore', [App\Http\Controllers\util_command\GitCommands::class, 'gitRestore']);
});

Route::group(['prefix' => 'util_generator'], function () {
    Route::get('createReferenceID/{identifier}', [App\Http\Controllers\util_generator\ReferenceID::class, 'create']);
});

Route::group(['prefix' => 'util_query'], function () {
    Route::get('count', [App\Http\Controllers\util_query\Count::class, 'count']);
    Route::get('insertGetID', [App\Http\Controllers\util_query\InsertGetID::class, 'insertGetID']);
    Route::get('fetchSingle', [App\Http\Controllers\util_query\FetchSingle::class, 'fetchSingle']);
    Route::get('fetchAll', [App\Http\Controllers\util_query\FetchAll::class, 'fetchAll']);
    Route::get('fetchPaginate', [App\Http\Controllers\util_query\FetchPaginate::class, 'fetchPaginate']);
    Route::get('fetchRandomRow', [App\Http\Controllers\util_query\FetchRandomRow::class, 'fetch']);
    Route::get('delete', [App\Http\Controllers\util_query\Delete::class, 'delete']);
    Route::get('update', [App\Http\Controllers\util_query\Update::class, 'update']);
});

Route::group(['prefix' => 'util_quiz'], function () {
    Route::get('initExcercises', [App\Http\Controllers\util_quiz\InitQuiz::class, 'excercises']);
    Route::get('initQuiz', [App\Http\Controllers\util_quiz\InitQuiz::class, 'quize']);
    Route::get('checkReads', [App\Http\Controllers\util_quiz\CheckReads::class, 'check']);
    Route::get('visualViewsChecker', [App\Http\Controllers\util_quiz\CheckReads::class, 'visualViewsChecker']);
    Route::get('resetReading', [App\Http\Controllers\util_quiz\ResetReading::class, 'reset']);
    Route::get('fetchRandomExam', [App\Http\Controllers\util_quiz\InitQuiz::class, 'fetchRandomExam']);
    Route::get('videoTutorials', [App\Http\Controllers\util_quiz\VideoTutorials::class, 'fetch']);
});
