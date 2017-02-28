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

    public $sourcePath = '@backend/web/metronic/assets';
    public $css = [

    ];

    public $js = [
        'global/scripts/app.min.js', // 框架app.js
        // 我扩展的js
        'extend/core/define.js',
        'extend/core/utils.js',
        '../../static/js/api.js',
    ];
    public $depends = [
        'backend\assets\PluginAsset',
    ];

    /**
     * 然后模板对应的js文件路径
     * @param string $route
     * @param $bath_path
     * @return bool|string
     */
    public static function get_js($route = '') {

        if ('' == $route) return $route;
        $js_path = explode('/', $route);
        $whole_path = '/static/js/views/' . $js_path[0] . '/' . $js_path[1] . '.js';
        if (is_file(Yii::getAlias('@webroot' . $whole_path))) return '@web' . $whole_path;
        else return false;
    }



}