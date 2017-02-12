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


    protected $account_status = [0 => '禁用', 10 => '正常'];

    public function actionIndex() {

        $list = (new Query())->select('id, username, email, status, created_at')->from('user')->orderBy(['created_at' => SORT_DESC])->all();
        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['status'] = $this->account_status[$v['status']];
            }
        }
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

    public function actionUser_del () {

        $id = Yii::$app->getRequest()->post('id');
        if ($id) {
            $model = new UserForm();
            if (!is_array($id) && $user = $model->findOne($id)) {
                if($user->delete()) return ['success' => 1, 'message' => '删除成功', 'data' => []];
                else return ['success' => 0, 'message' => '删除失败', 'data' => []];
            } elseif (is_array($id)) {
                $ids = implode(",", $id);
                $re = $model->deleteAll("id in (" . $ids .")");
                if ($re) return ['success' => 1, 'message' => '删除成功', 'data' => []];
                else return ['success' => 0, 'message' => '删除失败', 'data' => []];
            }
        }
    }


}