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
use yii;

class UserController extends BaseController {


    public function actionIndex() {

        $list = (new Query())->select('username, email, status, created_at')->from('user')->orderBy(['created_at' => SORT_DESC])->all();
        return parent::re_format($list);
    }

}