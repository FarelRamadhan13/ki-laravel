<?php  
namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class ApiAuthController extends Controller {

    public function login(AuthRequest $request) {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return $this->error(
                message: 'Email or password is incorrect.',
            );
        }

        $token = $user->createToken('api-token')->plainTextToken;
        unset($user['posts']);

        return $this->success(
            message: 'Login Successful',
            data: [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]
        );
    }

    public function logout(Request $request) {
        $request->currentAccessToken()->delete();

        return $this->success(
            message: 'Logout Successful'
        );
    }
}