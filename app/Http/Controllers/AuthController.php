<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Enums\EnumStatus;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->userService->createUser(UserDTO::fromRequest($request));
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->sendSuccess([
                'user' => UserResource::make($user),
                'token' => $token
            ], 'User created successfully');
        } catch (\Throwable $th) {
            return $this->sendError("User not created", $th->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return $this->sendError("Credentials not matched");
            }
            if(Auth::user()->status == EnumStatus::INACTIVE){
                Auth::user()->tokens()->delete();
                return $this->sendError("User is inactive");
            }
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->sendSuccess([
                'user' => UserResource::make($user),
                'token' => $token
            ], 'User logged in successfully');
        } catch (\Throwable $th) {
            return $this->sendError("User not logged in", $th->getMessage());
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->sendSuccess([], 'User logged out successfully');
    }

    public function profile(){
        $profile = UserResource::make(Auth::user());
        return $this->sendSuccess($profile, 'User profile retrieved successfully');
    }
}
