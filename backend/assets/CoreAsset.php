<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/1/17
 * Project: Cat Visual
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CoreAsset extends AssetBundle {

    public $basePath = '@webroot/metronic/assets';
    public $baseUrl = '@web/metronic/assets';

    public $css = [ // 全局css文件
        // 字体库
        'global/css/google_font.css',
        'global/plugins/font-awesome/css/font-awesome.min.css',
        'global/plugins/simple-line-icons/simple-line-icons.min.css',
        // bootstrap
        'global/plugins/bootstrap/css/bootstrap.min.css',
        'global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',

        'global/css/components-rounded.min.css', // 圆角组件样式
        'global/css/plugins.min.css', // 第三方插件定制化样式（稍靠后）

    ];
    public $js = [ // 全局js文件
        'global/plugins/jquery.min.js',
        'global/plugins/bootstrap/js/bootstrap.min.js',
        'global/plugins/js.cookie.min.js', // cookie manager
        'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js', // nice slimcroll similar facebook
        'global/plugins/jquery.blockui.min.js', // ajax遮罩层ui
        'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js', // bootstrap下拉选择

    ];
    public $depends = [];

}