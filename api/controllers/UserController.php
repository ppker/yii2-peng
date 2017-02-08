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

            $model->setPassword($model->password);
            $model->generateAuthKey();

            if ($user = $model->save()) {

                var_dump($user);die;
                if (Yii::$app->getUser()->login($user)) {
                    die('sss');
                    return $this->goHome();
                }
            }
        }
        die('sssss');
    }

}