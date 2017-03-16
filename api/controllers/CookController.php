<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/10
 * Project: Cat Visual
 */

namespace api\controllers;

use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Restaurant;
use Yii;

class CookController extends BaseController {

    protected $hotel_status = [0 => '停业整顿', 1 => '正常营业'];

    public function actionIndex() {

        $list = (new Query())->select("*")->from('restaurant')->where("status = :status", [":status" => parent::OK_STATUS])
        ->orderBy(['id' => SORT_DESC])->all();
        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['status'] = $this->hotel_status[$v['status']];
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
            }
        }
        return parent::re_format($list);
    }

    /**
     * 删除文件
     * @return array
     */
    public function actionImage_del() {

        $file = Yii::$app->request->post('file');
        if (empty($file)) return parent::re_format("", "json", ['删除成功', '删除失败']);
        $real_file = Yii::getAlias('@frontend/web/images/') . $file;

        if (is_file($real_file)) {
            if (unlink($real_file)) {
                return ['success' => 1, 'message' => '删除成功', 'data' => ''];
            } else return ['success' => 0, 'message' => '删除失败', 'data' => ''];
        } else return ['success' => 0, 'message' => '删除失败', 'data' => ''];

    }

    public function actionHotel_add() {

        $data = Yii::$app->request->post();
        $model = new Restaurant();

        if (empty($data['id'])) { // 新增
            unset($data['access-token'], $data['_csrf-backend']);
            $data['photo'] = $data['hotel_photo'];
            $model->load($data);
            if ($model->load($data) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            $menu = Menu::findOne((int)$data['id']);
            if (!empty($menu)) {
                unset($data['id'], $data['backend'], $data['access-token']);
                $data['photo'] = $data['hotel_photo'];
                if ($menu->load($data) && $menu->update()) {
                    return ['success' => 1, 'message' => '更新成功！', 'data' => []];
                } else return ['success' => 0, 'message' => '更新失败！', 'data' => []];
            }
        }
    }

    public function actionHotel_del () {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少菜单ID参数！', 'data' => []];

        if (is_array($id)) {
            if (Restaurant::deleteAll(['in', 'id', $id])) {
                return ['success' => 1, 'message' => '批量删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '批量删除失败！', 'data' => []];
        }else {
            if (Restaurant::findOne($id)->delete()) {
                return ['success' => 1, 'message' => '删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
        }
    }

    public function actionHotel_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '查询失败！', 'data' => []];
        $data = (new Restaurant())->find()->where(['id' => (int)$id])->asArray()->one();
        return parent::re_format($data);
    }




}