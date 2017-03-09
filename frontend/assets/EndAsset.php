<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/28
 * Project: Cat Visual
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii;
/**
 * Main backend application asset bundle.
 */
class EndAsset extends AssetBundle{

    public $sourcePath = '@common/metronic/assets';
    public $css = [
        'extend/plugins/revo-slider/css/settings.css',
        "layouts/layout3/css/layout.min.css",
        "layouts/layout3/css/themes/default.min.css",
        'extend/css/components.css',
        'extend/css/default.css',
        "layouts/layout3/css/custom.min.css",
        'extend/css/frontend_css.css',
    ];

    public $js = [
        'extend/plugins/revo-slider/js/jquery.themepunch.tools.min.js',
        'extend/plugins/revo-slider/js/jquery.themepunch.revolution.min.js',
        'global/scripts/app.js', // 框架app.js
        "layouts/layout3/scripts/layout.min.js",
        "layouts/layout3/scripts/demo.min.js",
        "layouts/global/scripts/quick-sidebar.min.js",
        "layouts/global/scripts/quick-nav.min.js"

    ];
    public $depends = [
        'frontend\assets\PluginAsset',
    ];



}