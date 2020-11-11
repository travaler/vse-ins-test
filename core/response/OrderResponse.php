<?php
namespace app\core\response;

use app\core\entities\Order;

class OrderResponse
{
    const STATUSES_MAP = [
        Order::STATUS_NEW => 'new',
        Order::STATUS_PAID => 'paid',
    ];

    public int $id;
    public string $status;
    public int $sum;

    /**
     * @param Order $order
     * @return static
     */
    public static function fromOrder(Order $order): self
    {
        $dto = new self();
        $dto->id = $order->id;
        $dto->status = self::STATUSES_MAP[$order->status];
        $dto->sum = $order->sum;

        return $dto;
    }
}