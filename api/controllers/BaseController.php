<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/4
 * Project: Cat Visual
 */

namespace api\controllers;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;
use yii\filters\auth\QueryParamAuth;
use yii;

class BaseController extends ActiveController {

    public $modelClass = 'common\models\User';

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
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function beforeAction($action) {

        parent::beforeAction($action);
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    /**
     * 清除默认的方法
     * @return array
     */
    public function actions() {

        return [];
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * 清除默认的verb限制
     * @return array
     */
    public function verbs() {

        return [];
    }

    /**
     * 格式化ajax的返回数据
     * @param array $data
     * @param string $type
     * @return array
     */
    public static function re_format($data = [], $type = 'json') {

        if ('json' == $type) {
            if (!empty($data)) return ['success' => 1, 'message' => '查询成功', 'data' => $data];
            else return ['success' => 0, 'message' => '查询失败', 'data' => []];
        }
    }

    public function checkAccess($action, $model = null, $params = []) {}

}