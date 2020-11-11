<?php
namespace app\core\services;

use app\core\response\OrderResponse;

interface OrderServiceInterface
{
    /**
     * @param array $productIds
     * @return int|null
     */
    public function create(array $productIds): ?int;

    /**
     * @param int $orderId
     * @param int $orderSum
     * @return OrderResponse|null
     */
    public function pay(int $orderId, int $orderSum): ?OrderResponse;
}