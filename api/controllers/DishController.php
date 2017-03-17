<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/17
 * Project: Cat Visual
 */

namespace api\controllers;

use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Restaurant;
use Yii;

class CookController extends BaseController {

    protected $dish_status = [0 => '在售', 1 => '下架'];
    public function actionIndex() {

        $list = (new Query())->select("*")->from('cookbook')->where("status = :status", [":status" => parent::OK_STATUS])
            ->orderBy(['id' => SORT_DESC])->all();

        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['status'] = $this->dish_status[$v['status']];
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
            }
        }
        return parent::re_format($list);
    }
}