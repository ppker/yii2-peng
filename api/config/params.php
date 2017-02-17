<?php
return [
    'adminEmail' => 'admin@example.com',
    'wechat' => [
    	'token' => 'yanzhipeng',
        'appid' => 'wx70a7adedc63835da',
        'appsecret' => '405b766d497f147c9063e91def45b1d3',
    ],
    'api_rule' => [
        'GET,POST index' => 'index',
        'GET,POST user_add' => 'user_add', // 新增账号
        'GET,POST user_del' => 'user_del', // 删除账号 需关联权限
        'GET,POST user_get' => 'user_get', // 获取用户信息
        'GET,POST user_reset' => 'user_reset', // 重置密码
        'GET,POST user_auth' => 'user_auth', // 用户授权
        'GET,POST access_index' => 'access_index', // 角色获取
        'GET,POST access_add' => 'access_add', // 角色添加
        'GET,POST access_get' => 'access_get', // 角色获取
    ],
];
