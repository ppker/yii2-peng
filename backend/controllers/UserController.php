<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/1/20
 * Project: Cat Visual
 */

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;

class UserController extends BaseController {

    public function init() {

        parent::init();

    }

    public function actionIndex() {

        return $this->render('index');
    }

}