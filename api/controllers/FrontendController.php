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
use common\models\UserOrder;
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
            if ($model->load(['dish_id' => (int)$data['dish'], 'hotel_id' => (int)$data['hotel'], 'user_id' => $user->id, 'num' => 1]) && $model->save()) {
                // 新增成功
                // 查询菜名，份数，价格
                // var_dump(['dish_id' => (int)$data['dish'], 'hotel_id' => (int)$data['hotel'], 'user_id' => $user->id]);die;
                $one_data = ShoppingCar::find()->select(['shopping_car.*', 'cookbook.name', 'cookbook.price'])->join('left join', 'cookbook', 'shopping_car.dish_id = cookbook.id')
                    ->where(['shopping_car.dish_id' => (int)$data['dish'], 'shopping_car.hotel_id' => (int)$data['hotel'], 'shopping_car.user_id' => $user->id])->asArray()->one();
                // $sql = $one_data->createCommand()->getRawSql();
                return ['success' => 1, 'message' => '添加成功！', 'data' => $one_data];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 有则加一
            if ($shoppingcar->updateCounters(['num' => 1])) {

                $one_data = ShoppingCar::find()->select(['shopping_car.*', 'cookbook.name', 'cookbook.price'])->join('left join', 'cookbook', 'shopping_car.dish_id = cookbook.id')
                    ->where(['shopping_car.dish_id' => (int)$data['dish'], 'shopping_car.hotel_id' => (int)$data['hotel'], 'shopping_car.user_id' => $user->id])->asArray()->one();
                // $sql = $one_data->createCommand()->getRawSql();
                return ['success' => 1, 'message' => '添加成功！', 'data' => $one_data];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        }


    }

    public function actionMinus_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['dish_id'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        $shoppingcar = ShoppingCar::findOne(['user_id' => $user->id, 'dish_id' => $data['dish_id']]);
        if ($shoppingcar->updateCounters(['num' => -1])) {
            return ['success' => 1, 'message' => '删除成功！', 'data' => $data['dish_id']];
        } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
    }

    public function actionPlus_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['dish_id'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        $shoppingcar = ShoppingCar::findOne(['user_id' => $user->id, 'dish_id' => $data['dish_id']]);
        if ($shoppingcar->updateCounters(['num' => 1])) {
            return ['success' => 1, 'message' => '添加成功！', 'data' => $data['dish_id']];
        } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
    }

    public function actionClear_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['access-token'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        if (ShoppingCar::deleteAll(['user_id' => $user->id])) {
            return ['success' => 1, 'message' => '清空购物车成功！', 'data' => true];
        } else return ['success' => 0, 'message' => '清空购物车失败！', 'data' => false];

    }

    public function actionQxd_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['access-token'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        $car = ShoppingCar::find()->where(['user_id' => $user->id])->andWhere([">", "num", "0"])->asArray()->all();

        if (!empty($car) && count($car)) {
            $insert_data = [];
            foreach($car as $v) {
                $insert_data[] = [$v['user_id'], $v['hotel_id'], $v['dish_id'], $v['num'], time(), time()];
            }

            $re = Yii::$app->db->createCommand()->batchInsert(UserOrder::tableName(), ['user_id', 'hotel_id', 'dish_id', 'num', 'created_at', 'updated_at'], $insert_data)->execute();
            if ($re) {
                ShoppingCar::deleteAll(['user_id' => $user->id]);
                return ['success' => 1, 'message' => '下单成功。', 'data' => []];
            } else return ['success' => 0, 'message' => '抱歉，下单失败。', 'data' => []];
        } else return ['success' => 0, 'message' => '抱歉，购物车是空的', 'data' => false];
    }



}