<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\JsonApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class ApiUserController extends Controller
{

    public function findUser(Request $request) {
        $user = $request->user();
        return $this->success(
            message: "Data user",
            data: $user
        );
    }

    public function login() {
        $user = User::first();

        return $this->success([
            'token' => $user->createToken('user-token')->plainTextToken
        ]);
    }

    public function index() {
        $users = User::all();

        return $this->success(
            UserResource::collection($users)
        );
    }

    public function store() {
        return $this->error(
            message: 'gagal '
        );
    }
}
 