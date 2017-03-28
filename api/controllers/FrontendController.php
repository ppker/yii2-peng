<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/25
 */

namespace api\controllers;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Restaurant;
use common\models\ShoppingCar;
use common\models\User;
use Yii;

class FrontendController extends BaseController {

    public function actionAdd_shoppingcar() {

        $data = Yii::$app->getRequest()->post();
        if (empty($data['dish']) || empty($data['hotel']) || empty($data['access-token'])) return ['success' => 0, 'message' => '抱歉，参数异常', 'data' => []];
        $model = new ShoppingCar();
        $user = User::findByUsername($data['access-token']);
        if (!$user) return ['success' => 0, 'message' => '抱歉，您没有权限', 'data' => []];
        // 拿到数据注入到购物车中
        $shoppingcar = $model::findOne(['user_id' => $user->id, 'hotel_id' => $data['hotel'], 'dish_id' => $data['dish']]);
        if (empty($shoppingcar)) {
            if ($model->load(['dish_id' => $data['dish'], 'hotel_id' => $data['hotel'], 'user_id' => $user->id, 'num' => 1]) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else {
            $shoppingcar->num += 1;
            if ($shoppingcar->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        }


    }
}