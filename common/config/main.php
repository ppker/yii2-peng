<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'setting' => [
            'class' => 'funson86\setting\Setting',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                    'depends' => [
                        'backend\assets\AppAsset'
                    ],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ]
            ],
        ],

    ],
];
