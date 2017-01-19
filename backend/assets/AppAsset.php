<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/metronic/assets';
    public $baseUrl = '@web/metronic/assets';
    public $css = [
        'global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
        'global/plugins/morris/morris.css',
        'global/plugins/fullcalendar/fullcalendar.min.css',
        'global/plugins/jqvmap/jqvmap/jqvmap.css',
        'layouts/layout/css/layout.min.css',
        'layouts/layout/css/themes/darkblue.min.css',
        'layouts/layout/css/custom.min.css',

    ];
    public $js = [
        'global/plugins/moment.min.js',
        'global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
        'global/plugins/morris/morris.min.js',
        'global/plugins/morris/raphael-min.js',
    ];
    public $depends = [
        // 'yii\web\YiiAsset', // yii.js jQuery.js
        // 'yii\bootstrap\BootstrapAsset', // bootstrap.css
        'backend\assets\IeAsset',
        'backend\assets\CoreAsset'
    ];

    public static function addScript($view, $jsfile) {

        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
    public static function addCss($view, $cssfile) {

        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }


}
