<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/4/1
 */

namespace api\controllers;

use yii\db\Query;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\ShoppingCar;
use Yii;


class GocarController extends BaseController {

    public function actionGocar_list() {

        $list = (new Query())->select("shopping_car.*, user.realname, restaurant.name as hotel_name, cookbook.name")->from("shopping_car")->leftJoin("user", 'user.id = shopping_car.user_id')
            ->leftJoin('restaurant', 'restaurant.id = shopping_car.hotel_id')->leftJoin('cookbook', 'cookbook.id = shopping_car.dish_id')->orderBy(['shopping_car.created_at' => SORT_DESC])->all();

        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
            }
        }
        return parent::re_format($list);
    }

    /**
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionGocar_add() {

        $data = Yii::$app->getRequest()->post();

        $model = new ShoppingCar();
        if (empty($data['id'])) { // 新增
            unset($data['access-token'], $data['_csrf-backend']);
            if ($model->load($data) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            $car = ShoppingCar::findOne((int)$data['id']);
            if (!empty($car)) {
                unset($data['id'], $data['backend'], $data['access-token']);
                if ($car->load($data) && $car->update()) {
                    return ['success' => 1, 'message' => '更新成功！', 'data' => []];
                } else return ['success' => 0, 'message' => '更新失败！', 'data' => []];
            }
        }

    }


    // gocar_get
    public function actionGocar_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '查询失败！', 'data' => []];
        $data = ShoppingCar::find()->where(['id' => (int)$id])->asArray()->one();
        return parent::re_format($data);
    }

    /**
     * gocar_del
     */
    public function actionGocar_del() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少购物车ID参数！', 'data' => []];

        if (is_array($id)) {
            if (ShoppingCar::deleteAll(['in', 'id', $id])) {
                return ['success' => 1, 'message' => '批量删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '批量删除失败！', 'data' => []];
        }else {
            if (ShoppingCar::findOne($id)->delete()) {
                return ['success' => 1, 'message' => '删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
        }
    }


}