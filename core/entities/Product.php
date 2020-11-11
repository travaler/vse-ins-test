<?php
namespace app\core\entities;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property int $price
 */
class Product extends ActiveRecord
{
    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return 'products';
    }
}