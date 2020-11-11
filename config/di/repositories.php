<?php
return [
    'definitions' => [

    ],
    'singletons' => [
        \app\core\repositories\ProductRepositoryInterface::class => \app\core\repositories\ProductArRepository::class,
        \app\core\repositories\OrderRepositoryInterface::class => \app\core\repositories\OrderArRepository::class,
    ],
];
