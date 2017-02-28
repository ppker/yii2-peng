<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@backend/web/metronic/assets';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
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
