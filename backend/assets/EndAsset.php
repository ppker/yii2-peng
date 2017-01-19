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
        'global/scripts/app.min.js',
        'pages/scripts/dashboard.min.js',
        'layouts/layout/scripts/layout.min.js',
        'layouts/layout/scripts/demo.min.js',
        'layouts/global/scripts/quick-sidebar.min.js',
        'layouts/global/scripts/quick-nav.min.js',
        'global/scripts/common.js',
    ];
    public $depends = [
        'backend\assets\PluginAsset'
    ];


}
