<?php
return [
    'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'components' => [
        'urlManager' => require(__DIR__.'/_urlManager.php'),
        'cache' => require(__DIR__.'/_cache.php'),
        'assetManager' => [
                        'bundles' => [
                                'yii\bootstrap\BootstrapAsset' => [
                            'sourcePath' => null, 'css' => []
                        ]

                        ]
                ],
    ],
];
