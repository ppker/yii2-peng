<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/20
 * Project: Cat Visual
 */

namespace backend\controllers;

use Yii;
use yii\helpers\Url;

class SystemController extends BaseController {

    public function init() {

        parent::init();
    }

    public function actionMenu() {

        return $this->render('menu');
    }

}