<?php
namespace app\core\services;

use app\core\entities\Order;
use app\core\entities\OrderItem;
use app\core\entities\Product;
use app\core\repositories\OrderRepositoryInterface;
use app\core\repositories\ProductRepositoryInterface;
use app\core\response\OrderResponse;

class OrderService implements OrderServiceInterface
{
    private ProductRepositoryInterface $productRepository;
    private OrderRepositoryInterface $orderRepository;
    private PaymentServiceInterface $paymentService;

    /**
     * OrderService constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param PaymentServiceInterface $paymentService
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        PaymentServiceInterface $paymentService
    ) {

        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->paymentService = $paymentService;
    }

    public function create(array $productIds): ?int
    {
        $products = $this->productRepository->findByIds($productIds);

        if (empty($products)) {
            return null;
        }

        $items = array_map(function (Product $product) {
            return OrderItem::create($product->id, $product->price);
        }, $products);

        $order = Order::create(
            $items,
            array_reduce($items, fn(int $carry, OrderItem $item) => $carry += $item->price, 0),
        );
        $this->orderRepository->save($order);

        return $order->id;
    }

    /**
     * @inheritDoc
     */
    public function pay(int $orderId, int $orderSum): ?OrderResponse
    {
        $order = $this->orderRepository->get($orderId);

        if (
            $order->sum === $orderSum
            && $order->status === Order::STATUS_NEW
            && $this->paymentService->pay()
        ) {
            $order->pay();
            $this->orderRepository->save($order);

            return OrderResponse::fromOrder($order);
        }

        return null;
    }
}