<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\User;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserController::class,'register']);

Route::post('login',[UserController::class,'login']);

Route::post('logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){

    Route::get('welcome',[UserController::class,'index']);

//route parameter binding
//Route::get('user/{id}',[UserController::class,'show']);
Route::prefix('user')->group(function(){
    //route model binding
    //user refers to the id of User Model instance
    //get a specific user
    Route::get('/{user}',[UserController::class,'show']);
    //get user profile
    Route::get('/{id}/profile',[UserController::class,'getProfile']);
    //get user tasks
    Route::get('/{id}/tasks',[UserController::class,'getTasks']);
});

//task routes
//only authenticated users can access task routes
Route::apiResource('tasks',TaskController::class);



Route::prefix('tasks')->group(function(){
    Route::get('/{id}/user',[TaskController::class,'getUser']);
    //add task categories
    Route::post('/{taskId}/categories',[TaskController::class,'addCategoriesToTask']);
    //get task categories
    Route::get('/{taskId}/categories',[TaskController::class,'getTaskCategories']);

    //get all tasks
   Route::get('/All',[TaskController::class,'getAllTasks'])->middleware('isAdmin');
});

Route::prefix('categories')->group(function(){
    Route::post('',[CategoryController::class,'store']);

    Route::get('/{category}',[CategoryController::class,'show']);
    //get category tasks
    Route::get('/{categoryId}/tasks',[CategoryController::class,'getTaskCategories']);
});

Route::prefix('profiles')->group(function(){

    Route::post('',[ProfileController::class,'store']);

    Route::get('/{profile}',[ProfileController::class,'show']);

    Route::put('/{profile}/update',[ProfileController::class,'update']);

});

});

