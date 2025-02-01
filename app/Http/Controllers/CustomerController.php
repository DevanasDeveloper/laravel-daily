<?php

namespace App\Http\Controllers;
use App\DTOs\CustomerDTO;
use App\Events\SendMailEvent;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Services\CustomerService;

class CustomerController extends BaseController
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService) {
        $this->customerService = $customerService;
    }

    public function index() {
        try {
            $customers = $this->customerService->getAllCustomers();
            return $this->sendSuccess($customers,"Customers retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Customers not retrieved",$th->getMessage());
        }
    }

    public function show($id) {
        try {
            $customer = $this->customerService->getCustomer($id);
            return $this->sendSuccess(CustomerResource::make($customer),"Customer retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Customer not retrieved",$th->getMessage());
        }
    }

    public function store(CustomerRequest $request) {
        try{
            $customer = $this->customerService->createCustomer(CustomerDTO::fromRequest($request));
            event(new SendMailEvent($customer,"The customer has been created"));
            return $this->sendSuccess(CustomerResource::make($customer),"Customer created successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Customer not created",$th->getMessage());
        }
        
    }

    public function update(CustomerRequest $request, $id) {
        try{
            $customer = $this->customerService->getCustomer($id);
            $this->customerService->updateCustomer($customer, CustomerDTO::fromRequest($request));
            event(new SendMailEvent($customer,"The customer has been updated"));
            return $this->sendSuccess(CustomerResource::make($customer),"Customer updated successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Customer not updated",$th->getMessage());
        }
        
    }

    public function destroy($id) {
        try{
            $customer = $this->customerService->getCustomer($id);
            $this->customerService->deleteCustomer($customer);
            event(new SendMailEvent($customer,"The customer has been destroyed"));
            return $this->sendSuccess(CustomerResource::make($customer),"Customer deleted successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Customer not deleted",$th->getMessage());
        }
        
    }

    public function changeStatus($id) {
        try{
            $customer = $this->customerService->getCustomer($id);
            $this->customerService->changeStatusCustomer($customer);
            event(new SendMailEvent($customer,"The customer status has been updated"));
            return $this->sendSuccess(CustomerResource::make($customer),"Customer status changed successfully");
        }catch (\Throwable $th) {
            return $this->sendError("Customer status not changed",$th->getMessage());
        }
    }
}
