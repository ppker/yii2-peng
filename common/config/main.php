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
                        // 'backend\assets\AppAsset' 切记切记 自己定制的话 就不要在这里加依赖了 因为全局不要加这种配置 否则会污染
                    ],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => []
                ]
            ],
        ],

    ],
];
