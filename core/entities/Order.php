<?php
namespace app\core\entities;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $status
 * @property int $sum
 *
 * @property OrderItem[] $items
 */
class Order extends ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_PAID = 2;

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['items'],
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function getItems(): ActiveQuery
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    /**
     * @param OrderItem[] $items
     * @param int $sum
     * @return Order
     */
    public static function create(array $items, int $sum): self
    {
        $order = new self();
        $order->status = self::STATUS_NEW;
        $order->sum = $sum;
        $order->items = $items;

        return $order;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->status === self::STATUS_PAID;
    }

    public function pay(): void
    {
        if ($this->isPaid()) {
            throw new \DomainException('Order is already paid');
        }

        $this->status = self::STATUS_PAID;
    }
}