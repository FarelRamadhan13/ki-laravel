<?php

use App\Models\User;
use App\Jobs\TestJob;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Tugas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\GuestUserMiddleware;
use App\Http\Controllers\Api\Auth\ApiAuthController;

Route::redirect('/', 'links');

Route::get('links', function () {
    return view('links');
})->name('links');



//TUGAS POST
Route::middleware(GuestUserMiddleware::class)->group(function() {
    Route::get('login', [Controllers\Auth\LoginController::class, 'loginView'])->name('login');
    Route::post('login', [Controllers\Auth\LoginController::class, 'login'])->name('login');
});

Route::middleware('web')->group(function () {
    Route::resource('posts', Controllers\Tugas\PostController::class);
    Route::post('logout', [Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

//END TUGAS POST


Route::prefix('articles')
        ->as('articles.')
        ->controller(Controllers\ArticleController::class)
        ->group(function () {

    Route::get('/', 'index')->name('index');

});

Route::prefix('tugas')
        ->name('tugas.')
        ->group(function () {

    Route::get('profile', [Tugas\ProfileController::class, 'index'])->name('profile');

    Route::resource('agents', Tugas\AgentController::class);

});



Route::get('artisan', function () {
    Artisan::call('app:create-user');

    $str = 'berhasil';
    $encrypt = encrypt($str);

    $decrypted = decrypt($encrypt);

    $hash = Hash::make('123');

    $verify = Hash::check('1234', $hash);

    return dd($encrypt, $decrypted, $hash, $verify);
});


// Route::get('api/{name?}/{page?}/{limit?}', function ($name = null, $page = 1, $limit = 10) {

    // if($name != null) {
    //     $api = Http::get("https://narutodb.xyz/api/character/search?name=$name")->json();
    //     // $api = $page . ' ' . $limit . $name;
    // } 
    
    // if ($name == null) {
    //     // $api = Http::get("https://narutodb.xyz/api/character?page=$page&limit=$limit");
    //     $api = $page . ' ' . $limit . $name;;
    // }
    
    
    // $api = collect($api->json()['characters']);
    // $api = $api->all();
    

    // return view('api.naruto', ['data' => $api]);
//     dd($name);   
// });

Route::get('job', function () {
    TestJob::dispatch();
})->name('job');


Route::controller(Controllers\QueryBuilderController::class)
    ->prefix('query-builder')
    ->group(function () {
        Route::get('/satu', 'satu');
        Route::get('/create', 'create');
});


Route::get('/accessor', function () {
    return User::create([
        'name' => 'Farel',
        'email' => 'farel@gmail.com',
        'password' => '123'
    ]);
});

Route::get('/mutator', function () {
    $user = User::first();

    dd($user->toArray());
});

Route::get('trait', function () {
    $user = User::email()->get();

    dd($user);
});

Route::get('component', function () {
    return view('component');
});

