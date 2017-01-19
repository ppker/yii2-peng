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
class PluginAsset extends AssetBundle {

    public $basePath = '@webroot/metronic/assets';
    public $baseUrl = '@web/metronic/assets';

    public $css = [ // 全局css文件

    ];
    public $js = [ // 全局js文件
        'global/plugins/counterup/jquery.waypoints.min.js',
        'global/plugins/counterup/jquery.counterup.min.js',
        'global/plugins/amcharts/amcharts/amcharts.js',
        'global/plugins/amcharts/amcharts/serial.js',
        'global/plugins/amcharts/amcharts/pie.js',
        'global/plugins/amcharts/amcharts/radar.js',
        'global/plugins/amcharts/amcharts/themes/light.js',
        'global/plugins/amcharts/amcharts/themes/patterns.js',
        'global/plugins/amcharts/amcharts/themes/chalk.js',
        'global/plugins/amcharts/ammap/ammap.js',
        'global/plugins/amcharts/ammap/maps/js/worldLow.js',
        'global/plugins/amcharts/amstockcharts/amstock.js',
        'global/plugins/fullcalendar/fullcalendar.min.js',
        'global/plugins/horizontal-timeline/horizontal-timeline.js',
        'global/plugins/flot/jquery.flot.min.js',
        'global/plugins/flot/jquery.flot.resize.min.js',
        'global/plugins/flot/jquery.flot.categories.min.js',
        'global/plugins/jquery-easypiechart/jquery.easypiechart.min.js',
        'global/plugins/jquery.sparkline.min.js',
        'global/plugins/jqvmap/jqvmap/jquery.vmap.js',
        'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
        'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js',
        'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js',
        'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
        'global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
        'global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];

}