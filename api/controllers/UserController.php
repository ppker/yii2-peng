<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/4
 * Project: Cat Visual
 */

namespace api\controllers;

use common\models\User;
use yii\db\Query;
use backend\models\UserForm;
use yii;

class UserController extends BaseController {


    public function actionIndex() {

        $list = (new Query())->select('id, username, email, status, created_at')->from('user')->orderBy(['created_at' => SORT_DESC])->all();
        return parent::re_format($list);
    }

    public function actionUser_add() {

        $model = new UserForm();


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            if ($user = $model->save()) {
                return ['success' => 1, 'message' => '添加成功', 'data' => []];
            }
        } else {
            $error_data = $model->getErrors();
            if (!empty($error_data) && is_array($error_data)) {
                return ['success' => 0, 'message' => current($error_data)[0], 'data' => []];
            } else {
                return ['success' => 0, 'message' => '填写的表单有不符合要求的内容，请检查', 'data' => []];
            }
        }
    }

}