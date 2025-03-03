<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function login(UserRequest $req) {

        if(!$req->validated()) {
            abort(404);
        }

        $req->session()->put('users', $req->username);
        return to_route('dashboard');
    }

    public function logout() {
        session()->flush();

        return to_route('login');
    }
}

