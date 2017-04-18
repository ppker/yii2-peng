<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/4/10
 * Project: Cat Visual
 */

namespace api\controllers;

use yii\db\Query;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\UserOrder;
use Yii;

class OrderController extends BaseController {

    public function actionOrder_list() {

        $list = (new Query())->select("user_order.*, user.realname, restaurant.name as hotel_name, cookbook.name, cookbook.price, (user_order.num * cookbook.price) as cook_total")->from("user_order")->leftJoin("user", 'user.id = user_order.user_id')
            ->leftJoin('restaurant', 'restaurant.id = user_order.hotel_id')->leftJoin('cookbook', 'cookbook.id = user_order.dish_id')->orderBy(['user_order.created_at' => SORT_DESC])->all();

        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
            }
        }
        return parent::re_format($list);
    }

    public function actionOrder_del() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少点餐订单ID参数！', 'data' => []];

        if (is_array($id)) {
            if (UserOrder::deleteAll(['in', 'id', $id])) {
                return ['success' => 1, 'message' => '批量删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '批量删除失败！', 'data' => []];
        }else {
            if (UserOrder::findOne($id)->delete()) {
                return ['success' => 1, 'message' => '删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
        }
    }

    public function actionOrder_add() {

        $data = Yii::$app->getRequest()->post();

        $model = new UserOrder();
        if (empty($data['id'])) { // 新增
            unset($data['access-token'], $data['_csrf-backend']);
            if ($model->load($data) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            $car = UserOrder::findOne((int)$data['id']);
            if (!empty($car)) {
                unset($data['id'], $data['backend'], $data['access-token']);
                if ($car->load($data) && $car->update()) {
                    return ['success' => 1, 'message' => '更新成功！', 'data' => []];
                } else return ['success' => 0, 'message' => '更新失败！', 'data' => []];
            }
        }
    }

    public function actionOrder_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '查询失败！', 'data' => []];
        $data = UserOrder::find()->where(['id' => (int)$id])->asArray()->one();
        return parent::re_format($data);
    }


}