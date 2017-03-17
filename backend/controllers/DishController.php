<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/17
 * Project: Cat Visual
 */

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class DishController extends BaseController {

    public function init() {

        parent::init();

    }

    public function actionIndex() {

        return $this->render('index');
    }

}