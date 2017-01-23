<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/1/23
 * Project: Cat Visual
 */

namespace api\controllers;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;
use yii;
use api\controllers\BaseController;

class TestController extends ActiveController {

    public $modelClass = '';

    public function behaviors() {

        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }


    public function beforeAction($action) {

        parent::beforeAction($action);
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionIndex() {

        return ['message' => 'successful', 'code' => 2];
    }





}