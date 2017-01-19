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
class IeAsset extends AssetBundle {

    public $basePath = '@webroot/metronic/assets';
    public $baseUrl = '@web/metronic/assets';
    public $css = [];
    public $js = [
        'global/plugins/respond.min.js',
        'global/plugins/excanvas.min.js',
        'global/plugins/ie8.fix.min.js',
    ];

    public $jsOptions = ['condition' => 'lt IE9'];

    public $depends = [];

}