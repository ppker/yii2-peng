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

        $list = (new Query())->select("shopping_car.*, user.username, restaurant.name as hotel_name, cookbook.name")->from("shopping_car")->leftJoin("user", 'user.id = shopping_car.user_id')
            ->leftJoin('restaurant', 'restaurant.id = shopping_car.hotel_id')->leftJoin('cookbook', 'cookbook.id = shopping_car.dish_id')->all();

        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
            }
        }
        return parent::re_format($list);
    }

    // gocar_add
    public function actionGocar_add() {

        var_dump(Yii::$app->getRequest()->post());die;
    }


}