<?php
return [
    'adminEmail' => 'admin@example.com',
    'wechat' => [
    	'token' => 'yanzhipeng',
        'appid' => 'wx70a7adedc63835da',
        'appsecret' => '405b766d497f147c9063e91def45b1d3',
    ],
    'api_rule_user' => [
        'GET,POST index' => 'index',
        'GET,POST user_add' => 'user_add', // 新增账号
        'GET,POST user_del' => 'user_del', // 删除账号 需关联权限
        'GET,POST user_get' => 'user_get', // 获取用户信息
        'GET,POST user_reset' => 'user_reset', // 重置密码
        'GET,POST user_auth' => 'user_auth', // 用户授权
        'GET,POST access_index' => 'access_index', // 角色获取
        'GET,POST access_add' => 'access_add', // 角色添加
        'GET,POST access_get' => 'access_get', // 角色获取
        'GET,POST access_del' => 'access_del', // 角色删除
    ],

    'api_rule_system' => [
        'GET,POST system_menu' => 'system_menu', // menu_list
        'GET,POST menu_add' => 'menu_add',
        'GET,POST init_form_api' => 'init_form_api', // 获取网站菜单项的下拉菜单
        'GET,POST menu_get' => 'menu_get',
        'GET,POST menu_del' => 'menu_del',
    ],

    'api_rule_cook' => [
        'GET,POST index' => 'index',
        'GET,POST image_del' => 'image_del',
        'GET,POST hotel_add' => 'hotel_add',
        'GET,POST hotel_del' => 'hotel_del',
        'GET,POST hotel_get' => 'hotel_get',
    ],

    'api_rule_dish' => [
        'GET,POST index' => 'index',
        'GET,POST init_form' => 'init_form',
        'GET,POST dish_get' => 'dish_get',
        'GET,POST dish_add' => 'dish_add',
        'GET,POST dish_del' => 'dish_del',
    ],

    'api_rule_frontend' => [
        'GET,POST add_shoppingcar' => 'add_shoppingcar',
    ],


];
