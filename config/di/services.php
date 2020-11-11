<?php
use yii\di\Container;

return [
    'definitions' => [

    ],
    'singletons' => [
        \app\core\services\OrderServiceInterface::class => \app\core\services\OrderService::class,
        \app\core\services\PaymentServiceInterface::class => function(Container $container) {
            return $container->get(\app\core\services\YandexPaymentService::class, [
                0 => Yii::$app->params['yandexPaymentUrl'],
            ]);
        },
    ],
];