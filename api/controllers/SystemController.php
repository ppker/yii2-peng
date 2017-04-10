<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/20
 * Project: Cat Visual
 */

namespace api\controllers;

use Yii;
use yii\db\Query;
use yii\helpers\Url;
use backend\models\Menu;
use common\models\User;
use common\models\CookBook;
use common\models\Restaurant;


class SystemController extends BaseController {

    public $hide = ['0' => '显示', 1 => '隐藏'];
    public $status = [0 => '禁用', 1 => '正常'];

    public function actionSystem_menu() {

        Menu::get_node_list(0);
        $list = Menu::$end_menu_list;
        // $list = (new Query())->select('*')->from('menu')->orderBy(['pid' => SORT_ASC, 'sort' => SORT_ASC])->all();
        if (!empty($list)) {
            foreach ($list as &$v) {
                $v['hide'] = $this->hide[$v['hide']];
                $v['status'] = $this->status[$v['status']];
            }
        }
        return parent::re_format($list);
    }

    public function actionMenu_add() {

        $data = Yii::$app->request->post();
        $model = new Menu();
        if (empty($data['id'])) { // 新增
            unset($data['id'], $data['_csrf-backend']);
            if ($model->load($data) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            $menu = Menu::findOne((int)$data['id']);
            if (!empty($menu)) {
                unset($data['id'], $data['backend']);
                if ($menu->load($data) && $menu->update()) {
                    return ['success' => 1, 'message' => '更新成功！', 'data' => []];
                } else return ['success' => 0, 'message' => '更新失败！', 'data' => []];
            }
        }
    }

    public function actionInit_form_api() {

        $data = Menu::find()->select(['id', 'name' => 'title'])->orderBy(['pid' => SORT_ASC, 'sort' => SORT_ASC])->asArray()->all();
        return parent::re_format($data);
    }

    /**
     * 获取所有用户的真实姓名,id
     * @return array
     */
    public function actionSelect_users_api() {

        $data = User::find()->select(["id", 'name' => 'realname'])->asArray()->all();
        return parent::re_format($data);
    }

    /**
     * 获取所有餐厅的菜肴 name, id
     * @return array
     */
    public function actionSelect_dishes_api() {

        $data = CookBook::find()->select(["id", "name"])->asArray()->all();
        return parent::re_format($data);
    }

    /**
     * 获取所有餐厅的 name, id
     * @return array
     */
    public function actionSelect_hotels_api() {

        $data = Restaurant::find()->select(["id", "name"])->asArray()->all();
        return parent::re_format($data);
    }


    public function actionMenu_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '查询失败！', 'data' => []];
        $data = (new Menu())->find()->where(['id' => (int)$id])->asArray()->one();
        return parent::re_format($data);
    }

    public function actionMenu_del() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少菜单ID参数！', 'data' => []];

        if (is_array($id)) {
            if (Menu::deleteAll(['in', 'id', $id])) {
                return ['success' => 1, 'message' => '批量删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '批量删除失败！', 'data' => []];
        }else {
            if (Menu::findOne($id)->delete()) {
                return ['success' => 1, 'message' => '删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
        }


    }

}
