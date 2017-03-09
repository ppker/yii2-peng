<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/3
 * Project: Cat Visual
 */

namespace api\controllers;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;
use yii;
// use api\controllers\BaseController;

class TestController extends ActiveController {

    public $modelClass = '';

    public function behaviors() {

        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON; // 设置支持的相应格式 默认 json xml
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [ // 跨域资源共享机制 cors
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true, // 允许证书 https
                'Access-Control-Max-Age' => 86400, // 请求的有效时间
            ],
        ];
        return $behaviors;
    }


    public function beforeAction($action) {

        parent::beforeAction($action);
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function actionValid() {


        return ['message' => 'successful', 'code' => 2];
    }



}