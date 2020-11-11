<?php
namespace app\forms;

use yii\base\Model;

class CreateOrderForm extends Model
{
    /** @var array */
    public $productIds;

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            ['productIds', 'each', 'rule' => ['integer']],
        ];
    }
}