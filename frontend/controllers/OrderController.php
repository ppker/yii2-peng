<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/4/18
 * Project: Cat Visual
 */

namespace frontend\controllers;

use Yii;

/**
 * Site controller
 */
class OrderController extends BaseController {

    public function actionLog() {

        return $this->render('log');
    }

}