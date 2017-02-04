<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EndAsset extends AssetBundle
{
    public $basePath = '@webroot/metronic/assets';
    public $baseUrl = '@web/metronic/assets';
    public $css = [

    ];
    public $js = [
        'global/scripts/app.min.js', // 框架app.js
        'pages/scripts/dashboard.min.js', // 页面的js逻辑
        'layouts/layout/scripts/layout.min.js', // 布局配置js
        'layouts/layout/scripts/demo.min.js', // demo js （页面逻辑）
        'layouts/global/scripts/quick-sidebar.min.js', // 快捷栏  就是我打算用socket聊天的那部分
        'layouts/global/scripts/quick-nav.min.js', // 就是右上角浮动的那个小圆圈圈
        'global/scripts/common.js', // 用户自定义的js
        // 我扩展的js
        'extend/core/utils.js',
        'extend/core/api.js',
        'extend/core/define.js'

    ];
    public $depends = [
        'backend\assets\PluginAsset',
        'backend\assets\TableAsset'
    ];

    /**
     * 拼装模板js文件路径
     * @param string $route
     * @param $bath_path
     * @return bool|string
     */
    public static function get_js($route = '', $bath_path) {

        if ('' == $route) return $route;
        $js_path = explode('/', $route);
        $whole_path = $bath_path . DIRECTORY_SEPARATOR . $js_path[0] . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . $js_path[1] . '.js';
        if (is_file($whole_path)) return '/backend/' . 'views/' . $js_path[0] . '/js/' . $js_path[1] . '.js';
        else return false;
    }

}
