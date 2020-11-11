<?php
namespace app\core\repositories;

use app\core\entities\Order;
use app\core\response\OrderResponse;

class OrderArRepository implements OrderRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function save(Order $order): void
    {
        if (!$order->save()) {
            throw new \RuntimeException('Saving order error');
        }
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): Order
    {
        if (!$order = Order::findOne($id)) {
            throw new \DomainException('Order not found');
        }

        return $order;
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $orders = Order::find()
            ->all();

        return array_map(function (Order $order) {
            return OrderResponse::fromOrder($order);
        }, $orders);
    }
}