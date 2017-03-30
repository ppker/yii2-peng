<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/25
 */

namespace api\controllers;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\Restaurant;
use common\models\ShoppingCar;
use common\models\User;
use Yii;

class FrontendController extends BaseController {

    public function actionAdd_shoppingcar() {

        $data = Yii::$app->getRequest()->post();

        if (empty($data['dish']) || empty($data['hotel']) || empty($data['access-token'])) return ['success' => 0, 'message' => '抱歉，参数异常', 'data' => []];
        $model = new ShoppingCar();
        $user = User::findByUsername($data['access-token']);
        if (!$user) return ['success' => 0, 'message' => '抱歉，您没有权限', 'data' => []];
        // 拿到数据注入到购物车中
        $shoppingcar = $model::findOne(['user_id' => $user->id, 'hotel_id' => $data['hotel'], 'dish_id' => $data['dish']]);

        if (empty($shoppingcar)) {
            if ($model->load(['dish_id' => (int)$data['dish'], 'hotel_id' => (int)$data['hotel'], 'user_id' => $user->id, 'num' => 1]) && $model->save()) {
                // 新增成功
                // 查询菜名，份数，价格
                // var_dump(['dish_id' => (int)$data['dish'], 'hotel_id' => (int)$data['hotel'], 'user_id' => $user->id]);die;
                $one_data = ShoppingCar::find()->select(['shopping_car.*', 'cookbook.name', 'cookbook.price'])->join('left join', 'cookbook', 'shopping_car.dish_id = cookbook.id')
                    ->where(['shopping_car.dish_id' => (int)$data['dish'], 'shopping_car.hotel_id' => (int)$data['hotel'], 'shopping_car.user_id' => $user->id])->asArray()->one();
                // $sql = $one_data->createCommand()->getRawSql();
                return ['success' => 1, 'message' => '添加成功！', 'data' => $one_data];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 有则加一
            if ($shoppingcar->updateCounters(['num' => 1])) {

                $one_data = ShoppingCar::find()->select(['shopping_car.*', 'cookbook.name', 'cookbook.price'])->join('left join', 'cookbook', 'shopping_car.dish_id = cookbook.id')
                    ->where(['shopping_car.dish_id' => (int)$data['dish'], 'shopping_car.hotel_id' => (int)$data['hotel'], 'shopping_car.user_id' => $user->id])->asArray()->one();
                // $sql = $one_data->createCommand()->getRawSql();
                return ['success' => 1, 'message' => '添加成功！', 'data' => $one_data];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        }


    }
}