<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/17
 * Project: Cat Visual
 */

namespace api\controllers;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Restaurant;
use common\models\CookBook;
use Yii;

class DishController extends BaseController {

    protected $dish_status = [0 => '在售', 1 => '下架'];

    public function actionIndex() {

        $list = (new Query())->select(['cookbook.*', 'hotel_name' => 'restaurant.name'])->from('cookbook')->join('LEFT JOIN', 'restaurant', 'restaurant.id = cookbook.res_id')
            ->orderBy(['cookbook.id' => SORT_DESC])->all();

        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['status'] = $this->dish_status[$v['status']];
                $v['updated_at'] = date('Y-m-d H:i:s', $v['updated_at']);
            }
        }
        return parent::re_format($list);
    }

    public function actionDish_del() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少菜单ID参数！', 'data' => []];

        if (is_array($id)) {
            if (CookBook::deleteAll(['in', 'id', $id])) {
                return ['success' => 1, 'message' => '批量删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '批量删除失败！', 'data' => []];
        }else {

            if (CookBook::findOne($id)->delete()) {
                return ['success' => 1, 'message' => '删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
        }
    }

    public function actionDish_add() {

        $data = Yii::$app->request->post();
        $model = new CookBook();


        if (empty($data['id'])) { // 新增
            unset($data['access-token'], $data['_csrf-backend']);
            $data = array_filter($data);
            $model->load($data);
            if ($model->load($data) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            $dish = CookBook::findOne((int)$data['id']);
            if (!empty($dish)) {
                unset($data['id'], $data['access-token'], $data['_csrf-backend']);
                if ($dish->load($data) && $dish->update()) {
                    return ['success' => 1, 'message' => '更新成功！', 'data' => []];
                } else return ['success' => 0, 'message' => '更新失败！', 'data' => []];
            }
        }
    }

    public function actionInit_form() {

        $data = Restaurant::find()->select(['id', 'name'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        return parent::re_format($data);
    }

    public function actionDish_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '查询失败！', 'data' => []];
        $data = CookBook::find()->where(['id' => (int)$id])->asArray()->one();
        return parent::re_format($data);
    }


}