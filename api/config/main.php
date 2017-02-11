<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
             'class' => 'api\modules\v1\Module'
         ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'error', 'warning'],
                    'logFile' => '@app/runtime/logs/api/api.log',
                    'logVars' => [],
                    'categories' => [
                        'api',
                    ]
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                /*['class' => 'yii\rest\UrlRule', 'controller' => 'v1/wechats',
                    'extraPatterns' => [
                        'GET,POST valid' => 'valid',
                        'GET,POST accesstoken' => 'accesstoken',
                        'GET serverip' => 'serverip',
                        'POST userinfo' => 'userinfo',
                        'POST pay' => 'pay',
                        'POST notify' => 'notify',
                        'POST config' => 'config',
                    ],
                ],*/
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user',
                    'extraPatterns' => [
                        'GET,POST index' => 'index',
                        'POST user_add' => 'user_add', // 新增账号
                        'POST user_del' => 'user_del', // 删除账号 需关联权限
                    ],
                ],
            ],
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],*/
        
    ],
    'params' => $params,
];
