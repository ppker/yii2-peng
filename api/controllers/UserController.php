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
use yii\helpers\ArrayHelper;
use yii;

class UserController extends BaseController {


    protected $account_status = [0 => '禁用', 10 => '正常'];

    public function actionIndex() {

        $list = (new Query())->select('id, username, email, status, created_at')->from('user')->orderBy(['created_at' => SORT_DESC])->all();
        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['status'] = $this->account_status[$v['status']];
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
            }
        }
        return parent::re_format($list);
    }

    public function actionUser_add() {

        $model = new UserForm();
        $post = Yii::$app->request->post();
        if (isset($post['id']) && !empty($post['id'])) {
            $user = $model->findOne($post['id']);
            if ($user->load($post) && $user->save()) {
                return ['success' => 1, 'message' => '更新成功', 'data' => []];
            } else return ['success' => 0, 'message' => '更新失败', 'data' => []];
        }


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

    public function actionUser_get() {

        $id = Yii::$app->getRequest()->post('id');
        if ($id) {
            $model = new UserForm();
            $user = $model->find()->where(['id' => $id])->asArray()->one();
            if (!empty($user)) return ['success' => 1, 'message' => '查询成功', 'data' => $user];
            else return ['success' => 0, 'message' => '查询失败', 'data' => []];
        }
    }

    public function actionUser_reset() {

        $id = Yii::$app->request->post('id');
        if ($id) {
            $user = User::findOne($id);
            $user->password = "123456";
            if ($user->save()) {
                return ['success' => 1, 'message' => '重置成功', 'data' => []];
            } else return ['success' => 0, 'message' => '重置失败', 'data' => []];
        }
    }

    /**
     * 获取用户的授权
     * @return array
     */
    public function actionUser_auth() {

        $id  = Yii::$app->request->post('id');
        if ($id) {
            $auth = Yii::$app->authManager;
            $roles = $auth->getRoles();
            $arr_roles = ArrayHelper::toArray($roles, [
                'yii\rbac\Role' => [
                    'type',
                    'name',
                    'description',
                    'ruleName',
                    'data',
                    'createdAt',
                    'updatedAt'
                ],
            ]);
            $group = array_keys($auth->getAssignments($id));
            if (!empty($arr_roles) || !empty($group)) {
                return ['success' => 1, 'message' => '查询成功', 'data' => ['all' => $arr_roles, 'now' => $group]];
            }else {
                return ['success' => 1, 'message' => '查询失败', 'data' => []];
            }
        }
    }


}