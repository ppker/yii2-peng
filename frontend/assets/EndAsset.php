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

    ];

    public $js = [
        'global/scripts/app.min.js', // 框架app.js
    ];
    public $depends = [
        'frontend\assets\PluginAsset',
    ];



}