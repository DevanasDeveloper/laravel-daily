<?php

namespace App\Services;

use App\DTOs\OrderDTO;
use App\Enums\EnumGateWay;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class OrderService {
    
    private $orderRepository;
    private $orderItemRepository;
    private $productRepository;
    private $paymentService;
    public function __construct(OrderRepositoryInterface $orderRepository,OrderItemRepositoryInterface $orderItemRepository,ProductRepositoryInterface $productRepository,PaymentService $paymentService) {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->productRepository = $productRepository;
        $this->paymentService = $paymentService;
    }

    public function getAllOrders(): array {
        return $this->orderRepository->all();
    }

    public function createOrder(OrderDTO $orderDTO, array $orderItems) : Order{
        $data = [
            'customer_id' => $orderDTO->customer_id,
            'total' => $orderDTO->total,
            'status' => $orderDTO->status
        ];

        $order = $this->orderRepository->create($data);

        $data_items= [];
        foreach ($orderItems as $orderItem) {
            $data_items[] = [
                'order_id' => $order->id,
                'product_id' => $orderItem['product_id'],
                'product_data' => $this->productRepository->find($orderItem['product_id']),
                'price'=> $orderItem['price'],
                'quantity' => $orderItem['quantity'],
                'total'=> $orderItem['total']
            ];
        }

        $this->orderItemRepository->insert($data_items);

        $this->paymentService->processPayment($order,EnumGateWay::PAYPAL);

        return $order;
    }

    public function getOrder(Int $id): ?Order {
        return $this->orderRepository->find($id);
    }

    public function deleteOrder(Order $model): bool {
        return $this->orderRepository->delete($model);
    }

}