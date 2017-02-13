<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/13
 * Project: Cat Visual
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class BaseController extends Controller {

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function init() {
        ini_set("memory_limit", "1024M");
        set_time_limit(0);
    }


}