<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthUserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(LoginRequest $request): JsonResponse
    {
        $email = $request->email;
        $password = $request->password;
        $deviceName = $request->deviceName ?? 'Unknown Device';

        $user = User::where('email', $email)->first();
        $validateUserPassword = Hash::check($password, $user->password);
        if (!$user || !$validateUserPassword) {
            return $this->error('Invalid credentials', 'InvalidCredentials', 401);
        }

        $newToken = $user->createToken($deviceName)->plainTextToken;

        return $this->success([
            'token' => $newToken
        ]);
    }

    public function getAuthUser(): JsonResponse
    {
        if (!Auth::check()) {
            return $this->error('Not Authenticated', 'NotAuthenticated', 401);
        }

        $user = Auth::user();
        return $this->success(new AuthUserResource($user));
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
