<?php  

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\Auth\ApiAuthController;

// Route::get('/users', function () {
//     $users = User::all();
//     return UserResource::collection($users)->resolve();
// });

// Route::get('/users/{id}', function ($id) {
//     $users = User::findOrFail($id);
//     return UserResource::make($users)->resolve();
// });


//ISDFHIOANOSD
// Route::post('/users/login', [ApiUserController::class, 'login']);

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('/users', [ApiUserController::class, 'index']);
//     Route::post('/users', [ApiUserController::class, 'store']);
// });



//TUGAS POST

Route::post('auth/login', [ApiAuthController::class, 'login'])->name('api.login');
Route::post('auth/logout', [ApiAuthController::class, 'logout'])->name('api.logout');


Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get('users/single', [ApiUserController::class, 'findUser']);
    Route::apiResource('posts', ApiPostController::class);
});

//TUGAS POST