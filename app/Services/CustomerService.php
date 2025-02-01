<?php

namespace App\Services;

use App\DTOs\CustomerDTO;
use App\Models\User;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class CustomerService {
    
    private $customerRepository;
    public function __construct(CustomerRepositoryInterface $customerRepository) {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers(): array {
        return $this->customerRepository->all();
    }

    public function createCustomer(CustomerDTO $customerDTO) {
        $data = [
            'fullname' => $customerDTO->fullname,
            'email' => $customerDTO->email,
            'password' => $customerDTO->password,
            'phone' => $customerDTO->phone,
            'address' => $customerDTO->address,
            'status' => $customerDTO->status,
            'role' => $customerDTO->role,
        ];
        return $this->customerRepository->create($data);
    }

    public function updateCustomer(User $customer, CustomerDTO $customerDTO) : Bool {
        $data = [
            'fullname' => $customerDTO->fullname,
            'phone' => $customerDTO->phone,
            'email' => $customerDTO->email,
            'address' => $customerDTO->address,
            'status' => $customerDTO->status,
            'role' => $customerDTO->role,
            'password' =>  $customerDTO->password
        ];
        if($customerDTO->password) {
            $data['password'] = Hash::make($customerDTO->password);
        }else {
            $data['password'] = $customer->password;
        }
        return $this->customerRepository->update($customer, $data);
    }

    public function getCustomer(Int $id): ?User {
        return $this->customerRepository->find($id);
    }

    public function deleteCustomer(User $customer): bool {
        return $this->customerRepository->delete($customer);
    }

    public function changeStatusCustomer(User $customer): bool {
        return $this->customerRepository->changeStatus($customer);
    }

}