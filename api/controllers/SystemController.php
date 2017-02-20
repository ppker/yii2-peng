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

class SystemController extends BaseController {

    public $hide = ['0' => '显示', 1 => '隐藏'];
    public $status = [0 => '禁用', 1 => '正常'];

    public function actionSystem_menu() {

        $list = (new Query())->select('*')->from('menu')->orderBy(['pid' => SORT_ASC, 'sort' => SORT_ASC])->all();
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
        if (empty($data['id'])) { // 新增
            $model = new Menu();
            if ($model->load($data) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            die('ssss');
        }
    }

}
