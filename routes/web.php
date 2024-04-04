<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Models\user_company;
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

Route::get('/', function () {
    return view('welcome');
})->name("WelcomePage");
// Users Routes
Route::get("/users", [UsersController::class, 'index'])->name("users.index");
Route::post("/users", [UsersController::class, "store"])->name("users.store");
Route::get("/users/create", [UsersController::class, 'create'])->name("users.create");
Route::get("/users/{userid}/edit", [UsersController::class, 'edit'])->name("users.edit");
Route::put("/users/{userid}", [UsersController::class, 'update'])->name("users.update");
Route::get("/users/{userid}", [UsersController::class, 'show'])->name("users.show");
Route::delete("/users/{userid}", [UsersController::class, 'destroy'])->name("users.destroy");
Route::delete("/users", [UsersController::class, 'clear'])->name("users.clear");
// Posts Routes
Route::get("/posts", [PostsController::class, 'index'])->name("posts.index");
Route::post("/posts", [PostsController::class, "store"])->name("posts.store");
Route::get("/posts/create", [PostsController::class, 'create'])->name("posts.create");
Route::get("/posts/{postid}/edit", [PostsController::class, 'edit'])->name("posts.edit");
Route::put("/posts/{postid}", [PostsController::class, 'update'])->name("posts.update");
Route::get("/posts/{postid}", [PostsController::class, 'show'])->name("posts.show");
Route::delete("/posts/{postid}", [PostsController::class, 'destroy'])->name("posts.destroy");
Route::delete("/posts", [PostsController::class, 'clear'])->name("posts.clear");
