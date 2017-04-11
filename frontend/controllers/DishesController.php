<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/19
 */

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Restaurant;
use common\models\CookBook;
use common\models\ShoppingCar;


/**
 * Site controller
 */
class DishesController extends BaseController {

    public function actionList($id) {

        if (Yii::$app->user->isGuest) {
            // return $this->flash('抱歉,请先登录!', 'error');
            return $this->success(['message' => '恭喜你操作成功!', 'type' => 'success', 'url' => '/']);
            // return $this->goHome();
        }
        if ("" == $id) $this->redirect("site/error");
        $hotel_info = Restaurant::findOne(['id' => $id, 'status' => 1]);
        $dishes_info = CookBook::findAll(['res_id' => $id, 'status' => 1]);

        $user_id = Yii::$app->user->identity->id;
        $car_list = ShoppingCar::find()->select(['shopping_car.*', 'cookbook.name', 'cookbook.price'])->join('left join', 'cookbook', 'shopping_car.dish_id = cookbook.id')
            ->where(['shopping_car.user_id' => $user_id])->andWhere(['>', 'shopping_car.num', '0'])->orderBy(['created_at' => SORT_ASC])->asArray()->all();
        $car_total_price = 0;
        $car_total_num = 0;
        foreach ($car_list as $k => $v) {
            $car_total_num += $v['num'];
            $car_total_price += $v['price'] * $v['num'];
        }

        return $this->render("dishes", ['hotel' => $hotel_info, 'dishes' => $dishes_info, 'car_list' => $car_list, 'car_total' => ['car_total_num' => $car_total_num, 'car_total_price' => $car_total_price]]);

    }




}