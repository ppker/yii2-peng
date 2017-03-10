<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/9
 */

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

class CookController extends BaseController {

    public function init() {

        parent::init();

    }

    public function actionIndex() {

        return $this->render('index');
    }

}