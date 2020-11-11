<?php
namespace app\core\repositories;

use app\core\entities\Order;
use app\core\response\OrderResponse;

interface OrderRepositoryInterface
{
    /**
     * @param Order $order
     * @throws \RuntimeException
     */
    public function save(Order $order): void;

    /**
     * @param int $id
     * @return Order
     * @throws \DomainException
     */
    public function get(int $id): Order;

    /**
     * @return OrderResponse[]
     */
    public function all(): array;
}