<?php

use App\Http\Controllers\Api\CommentsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('/comments', [CommentsApiController::class, 'index'])->name('api.comments');
Route::post('/comment/create', [CommentsApiController::class, 'store'])->name('api.comment.create');
Route::delete('/comment/destroy/{comment}', [CommentsApiController::class, 'destroy'])->name('api.comment.destroy');
Route::patch('/comment/update/{comment}', [CommentsApiController::class, 'update'])->name('api.comment.update');

Route::get('/comment/{element}/element', [CommentsApiController::class, 'showComments'])->name('api.comment.element.show');
Route::get('/comments/filter/{status}', [CommentsApiController::class, 'filterStatus'])->name('comments.filter.status');
