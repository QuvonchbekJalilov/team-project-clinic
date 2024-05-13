<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\analyze;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        $random_unique_id = mt_rand(111111, 999999);
        $user = $request->validated();
        if (request()->hasFile('image')) {
            $path = $request->file('image')->store('user/' . time(), 'public');
        }

        $user = User::create([
            'unique_id' => $random_unique_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'image' => $path ?? null,
            'role' => 'customer'
        ]);

        analyze::create([
            'user_unique_id' => $random_unique_id
        ]);

        $token = $user->createToken('main')->plainTextToken;

        return $this->success('user created successfully', $token);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $this->success('', ['token' => $user->createToken('main')->plainTextToken]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return $this->success('user logged out successfully');
    }
}
