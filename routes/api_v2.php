<?php  

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    $users = User::all();
    return $users;
});