<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Enums\EnumStatus;
use App\Events\SendMailEvent;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index() {
        try {
            $users = $this->userService->getAllUsers();
            return $this->sendSuccess($users,"Users retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Users not retrieved",$th->getMessage());
        }
    }

    public function show($id) {
        try {
            $user = $this->userService->getUser($id);
            return $this->sendSuccess(UserResource::make($user),"User retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("User not retrieved",$th->getMessage());
        }
    }

    public function store(UserRequest $request) {
        try{
            $user = $this->userService->createUser(UserDTO::fromRequest($request));
            event(new SendMailEvent($user,"The user has been created"));
            return $this->sendSuccess(UserResource::make($user),"User created successfully");
        }catch (\Throwable $th) {
            return $this->sendError("User not created",$th->getMessage());
        }
        
    }

    public function update(UserRequest $request, $id) {
        try{
            $user = $this->userService->getUser($id);
            $this->userService->updateUser($user, UserDTO::fromRequest($request));
            event(new SendMailEvent($user,"The user has been updated"));
            return $this->sendSuccess(UserResource::make($user),"User updated successfully");
        }catch (\Throwable $th) {
            return $this->sendError("User not updated",$th->getMessage());
        }
        
    }

    public function destroy($id) {
        try{
            $user = $this->userService->getUser($id);
            $this->userService->deleteUser($user);
            event(new SendMailEvent($user,"The user has been destroyed"));
            return $this->sendSuccess(UserResource::make($user),"User deleted successfully");
        }catch (\Throwable $th) {
            return $this->sendError("User not deleted",$th->getMessage());
        }
        
    }

    public function changeStatus($id) {
        try{
            $user = $this->userService->getUser($id);
            $this->userService->changeStatusUser($user);
            event(new SendMailEvent($user,"The user status has been updated"));
            return $this->sendSuccess(UserResource::make($user),"User status changed successfully");
        }catch (\Throwable $th) {
            return $this->sendError("User status not changed",$th->getMessage());
        }
    }
}
