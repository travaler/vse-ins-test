<?php
return \yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/di/repositories.php',
    require __DIR__ . '/di/services.php',
    [
        'definitions' => [

        ],
        'singletons' => [

        ],
    ],
);
