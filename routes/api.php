<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [UserController::class, 'login']);
Route::get('/articles', [ArticleController::class, 'getAllArticles']);
Route::get('/articles/{article}', [ArticleController::class, 'getArticle']);


Route::middleware('auth:api')->group(function(){
    Route::post('/articles', [ArticleController::class, 'createArticle']);
    Route::put('/articles/{article}', [ArticleController::class, 'updateArticle']);
    Route::delete('/articles/{article}', [ArticleController::class, 'deleteArticle']);
});

Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});

Route::get('/create-user', function(){
    User::forceCreate([
        'name' => 'Shahadat Hossain',
        'email' => 'msh.shuvooo@gmail.com',
        'password' => Hash::make('12345678'),
    ]);
    User::forceCreate([
        'name' => 'Thomas Maxon',
        'email' => 'tom@wardtech.co.uk',
        'password' => Hash::make('12345678'),
    ]);
});

Route::get('/create-token', function(){
    $user = User::find(4);
    $user->api_token = Str::random(80);
    $user->save();

    $user = User::find(5);
    $user->api_token = Str::random(80);
    $user->save();
});
