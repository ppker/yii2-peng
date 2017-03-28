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
            'enableSession' => false,
            'loginUrl' => null
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
                    'extraPatterns' => isset($params['api_rule_user']) ? $params['api_rule_user'] : [],
                    'pluralize' => false,
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'system',
                    'extraPatterns' => isset($params['api_rule_system']) ? $params['api_rule_system'] : [],
                    'pluralize' => false,
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'cook',
                    'extraPatterns' => isset($params['api_rule_cook']) ? $params['api_rule_cook'] : [],
                    'pluralize' => false,
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'dish',
                    'extraPatterns' => isset($params['api_rule_dish']) ? $params['api_rule_dish'] : [],
                    'pluralize' => false,
                ],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'frontend',
                    'extraPatterns' => isset($params['api_rule_frontend']) ? $params['api_rule_frontend'] : [],
                    'pluralize' => false,
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


    /**
     * 静态加载行为供全局使用
     */
    'as rbac' => [
        'class' => 'api\behaviors\RbacBehavior',
        'allowActions' => ['site/error', 'frontend/*'],
    ],

    'params' => $params,
];
