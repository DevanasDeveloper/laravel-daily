<?php

namespace App\Services;

use App\DTOs\OrderDTO;
use App\Enums\EnumGateWay;
use App\Enums\EnumOrderStatus;
use App\Enums\EnumPaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\PaymentGateWay\PaymentGateWayFactory;
use Illuminate\Validation\Rules\Enum;

class PaymentService {
    private $paymentRepository;
    private $orderRepository;
    public function __construct(PaymentRepositoryInterface $paymentRepository,OrderRepositoryInterface $orderRepository) {
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
    }

    public function getPaymentsByOrder(Order $order): array {
        return $this->paymentRepository->findByOrder($order);
    }

    public function processPayment(Order $order,EnumGateWay $paymentMethod) : Payment{
        $data = [
            'order_id' => $order->id,
            'amount' => $order->total,
            'payment_method'=> $paymentMethod, 
            'payment_status' => EnumPaymentStatus::PENDING
        ];

        $paymentGateWay = PaymentGateWayFactory::make(EnumGateWay::CASH);

        $response = $paymentGateWay->charge($data);

        if($response['status']) {
            $data['transaction_id'] = $response['transaction_id'];
            $data['payment_status'] = EnumPaymentStatus::COMPLETED;
        }else {
            $data['payment_status'] = EnumPaymentStatus::FAILED;
        }

        $payment = $this->paymentRepository->create($data);

        $this->orderRepository->changeStatus($order,EnumOrderStatus::PAID);

        return $payment;
    }

}