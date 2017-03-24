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


/**
 * Site controller
 */
class DishesController extends BaseController {

    public function actionList($id) {

        if ("" == $id) $this->redirect("site/error");
        $hotel_info = Restaurant::findOne(['id' => $id, 'status' => 1]);
        $dishes_info = CookBook::findAll(['res_id' => $id, 'status' => 1]);
        return $this->render("dishes", ['hotel' => $hotel_info, 'dishes' => $dishes_info]);
    }

}