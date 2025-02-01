<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService {
    
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array {
        return $this->userRepository->all();
    }

    public function createUser(UserDTO $userDTO) {
        $data = [
            'fullname' => $userDTO->fullname,
            'email' => $userDTO->email,
            'password' => $userDTO->password,
            'phone' => $userDTO->phone,
            'address' => $userDTO->address,
            'status' => $userDTO->status,
            'role' => $userDTO->role,
           
        ];
        return $this->userRepository->create($data);
    }

    public function updateUser(User $model, UserDTO $userDTO) : Bool {
        $data = [
            'fullname' => $userDTO->fullname,
            'phone' => $userDTO->phone,
            'email' => $userDTO->email,
            'address' => $userDTO->address,
            'status' => $userDTO->status,
            'role' => $userDTO->role,
            'password' =>  $userDTO->password
        ];
        if($userDTO->password) {
            $data['password'] = Hash::make($userDTO->password);
        }else {
            $data['password'] = $model->password;
        }
        return $this->userRepository->update($model, $data);
    }

    public function getUser(Int $id): ?User {
        return $this->userRepository->find($id);
    }

    public function deleteUser(User $model): bool {
        return $this->userRepository->delete($model);
    }

    public function changeStatusUser(User $model): bool {
        return $this->userRepository->changeStatus($model);
    }

}