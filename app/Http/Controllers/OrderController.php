<?php

namespace App\Http\Controllers;

use App\DTOs\OrderDTO;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    private $orderService;

    public function __construct(OrderService $orderService) 
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
       try {
            $orders = $this->orderService->getAllOrders();
            return $this->sendSuccess($orders,"Orders retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Orders not retrieved",$th->getMessage());
        }
    }

    public function show(Int $id){
        try {
            $order = $this->orderService->getOrder($id);
            return $this->sendSuccess($order,"Order retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("Order not retrieved",$th->getMessage());
        }
    }

    public function store(OrderRequest $request){
        DB::beginTransaction();
        try {
            $order = $this->orderService->createOrder(OrderDTO::fromRequest($request),$request->order_items);
            DB::commit();
            return $this->sendSuccess($order,"Order created successfully");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError("Order not created",$th->getMessage());
        }
    }

    public function destory(Int $id){
        DB::beginTransaction();
        try {
            $order = $this->orderService->getOrder($id);
            $order = $this->orderService->deleteOrder($order);
            DB::commit();
            return $this->sendSuccess($order,"Order deleted successfully");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->sendError("Order not deleted",$th->getMessage());
        }
    }


}