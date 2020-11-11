<?php
namespace app\core\entities;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $price
 *
 * @property Order $order
 * @property Product $product
 */
class OrderItem extends ActiveRecord
{
    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    public function getOrder(): ActiveQuery
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * @param int $productId
     * @param int $price
     * @return static
     */
    public static function create(int $productId, int $price): self
    {
        $item = new self();
        $item->product_id = $productId;
        $item->price = $price;

        return $item;
    }
}