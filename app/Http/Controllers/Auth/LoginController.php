<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function loginView(Request $request) {
        return view('auth_v2.login');
    }

    public function login(AuthRequest $request) {
        $credentials = $request->validated();

        $response = Http::acceptJson()->withoutRedirecting()->asForm()->post(route('api.login'), $credentials);
        
        // dd($response->status(), $response->body());

        if($response->successful()) {
            $data = $response->json();
            // dd($data['data']['access_token']);
            session([
                'api_token' => $data['data']['access_token'],
                'user' => $data['data']['user'],
            ]);

            return to_route('posts.index');
        }

        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
            'password' => 'Email or password is incorrect.'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        $token = session('api_token');
        if ($token) {
            Http::withToken($token)->post(url('/api/logout'));
            session()->forget('api_token');
            session()->forget('user');
        }
        return to_route('login');
    }
}
