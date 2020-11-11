<?php
namespace app\forms;

use yii\base\Model;

class PayOrderForm extends Model
{
    /** @var int */
    public $orderId;

    /** @var int */
    public $orderSum;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [['orderId', 'orderSum',], 'integer'],
        ];
    }
}