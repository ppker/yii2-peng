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
use common\models\UserOrder;
use common\models\User;
use common\models\UserLog;
use common\models\CookBook;
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

    public function actionMinus_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['dish_id'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        $shoppingcar = ShoppingCar::findOne(['user_id' => $user->id, 'dish_id' => $data['dish_id']]);
        if ($shoppingcar->updateCounters(['num' => -1])) {
            return ['success' => 1, 'message' => '删除成功！', 'data' => $data['dish_id']];
        } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
    }

    public function actionPlus_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['dish_id'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        $shoppingcar = ShoppingCar::findOne(['user_id' => $user->id, 'dish_id' => $data['dish_id']]);
        if ($shoppingcar->updateCounters(['num' => 1])) {
            return ['success' => 1, 'message' => '添加成功！', 'data' => $data['dish_id']];
        } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
    }

    public function actionClear_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['access-token'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        if (ShoppingCar::deleteAll(['user_id' => $user->id])) {
            return ['success' => 1, 'message' => '清空购物车成功！', 'data' => true];
        } else return ['success' => 0, 'message' => '清空购物车失败！', 'data' => false];

    }

    public function actionQxd_shopping_car() {

        $data = Yii::$app->getRequest()->post();
        $user = User::findByUsername($data['access-token']);
        if (!$user || empty($data) || empty($data['access-token'])) return ['success' => 0, 'message' => '抱歉，数据异常', 'data' => []];
        $car = ShoppingCar::find()->where(['user_id' => $user->id])->andWhere([">", "num", "0"])->asArray()->all();

        if (!empty($car) && count($car)) {
            $insert_data = [];
            foreach($car as $v) {
                $insert_data[] = [$v['user_id'], $v['hotel_id'], $v['dish_id'], $v['num'], time(), time()];
            }

            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $re1 = $db->createCommand()->batchInsert(UserOrder::tableName(), ['user_id', 'hotel_id', 'dish_id', 'num', 'created_at', 'updated_at'], $insert_data)->execute();
                $re2 = ShoppingCar::deleteAll(['user_id' => $user->id]);
                $transaction->commit();
                return ['success' => 1, 'message' => '下单成功。', 'data' => []];
            } catch (\Exception $e) {
                $transaction->rollBack();
                return ['success' => 0, 'message' => '抱歉，下单失败。', 'data' => []];
            }
        } else return ['success' => 0, 'message' => '抱歉，购物车是空的', 'data' => false];
    }

    /**
     * 饭店点赞和踩
     */
    public function actionLike_hate() {

        $data = Yii::$app->getRequest()->post();
        $user_id = Yii::$app->getUser()->identity->id;
        if (empty($data)) return ['success' => 0, 'message' => '抱歉，参数异常', 'data' => ''];
        $model_log = new UserLog();
        switch($data['data-type']) {
            case 'hotel':
                $hotel = Restaurant::findOne($data['data-id']);
                if ($hotel) {
                    // 用户今天的操作记录
                    $user_log = UserLog::find()->where(['user_id' => $user_id, 'action' => 'zan', 'controller' => 'frontend'])
                        ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d'))])->one();

                    $user_log_hate = UserLog::find()->where(['user_id' => $user_id, 'action' => 'hate', 'controller' => 'frontend'])
                        ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d'))])->one();

                    if ('zan' == $data['data-do']) {
                        if (empty($user_log)) { // 还没有进行点赞
                            $re = $hotel->updateCounters(['zan' => 1]);
                            if ($re) { // 更新用户操作-点赞记录
                                if ($model_log->load(['user_id' => $user_id, 'action' => 'zan', 'controller' => 'frontend']) && $model_log->save()) {}
                                return ['success' => 1, 'message' => '点赞成功', 'data' => 1];
                            }
                        } else { // 已经进行点赞
                            $re = $hotel->updateCounters(['zan' => -1]);
                            if ($re) { // 更新用户操作-点赞记录
                                UserLog::deleteAll('user_id = :user_id and action = :action and controller = :controller and created_at >= :created_at', [':user_id' => $user_id,
                                    ':action' => 'zan', ':controller' => 'frontend', ':created_at' => strtotime(date('Y-m-d'))]);
                                return ['success' => 1, 'message' => '取消点赞', 'data' => -1];
                            }
                        }
                    } elseif ('hate' == $data['data-do']) {
                        if (empty($user_log_hate)) { // 还没有进行踩
                            $re = $hotel->updateCounters(['hate' => 1]);
                            if ($re) { // 更新用户操作-点赞记录
                                if ($model_log->load(['user_id' => $user_id, 'action' => 'hate', 'controller' => 'frontend']) && $model_log->save()) {}
                                return ['success' => 1, 'message' => '点踩成功', 'data' => 1];
                            }
                        } else { // 踩过了
                            $re = $hotel->updateCounters(['hate' => -1]);
                            if ($re) { // 更新用户操作-点赞记录
                                UserLog::deleteAll('user_id = :user_id and action = :action and controller = :controller and created_at >= :created_at', [':user_id' => $user_id,
                                    ':action' => 'hate', ':controller' => 'frontend', ':created_at' => strtotime(date('Y-m-d'))]);
                                return ['success' => 1, 'message' => '取消踩', 'data' => -1];
                            }
                        }
                    }
                }
                break;

            case 'dish':
                $dish = CookBook::findOne($data['data-id']);
                if ($dish) {
                    // 用户今天的操作记录
                    $user_log = UserLog::find()->where(['user_id' => $user_id, 'action' => 'zan', 'controller' => 'dish'])
                        ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d'))])->one();

                    $user_log_hate = UserLog::find()->where(['user_id' => $user_id, 'action' => 'hate', 'controller' => 'dish'])
                        ->andWhere(['>=', 'created_at', strtotime(date('Y-m-d'))])->one();

                    if ('zan' == $data['data-do']) {
                        if (empty($user_log)) { // 还没有进行点赞
                            $re = $dish->updateCounters(['zan' => 1]);
                            if ($re) { // 更新用户操作-点赞记录
                                if ($model_log->load(['user_id' => $user_id, 'action' => 'zan', 'controller' => 'dish']) && $model_log->save()) {}
                                return ['success' => 1, 'message' => '点赞成功', 'data' => 1];
                            }
                        } else { // 已经进行点赞
                            $re = $dish->updateCounters(['zan' => -1]);
                            if ($re) { // 更新用户操作-点赞记录
                                UserLog::deleteAll('user_id = :user_id and action = :action and controller = :controller and created_at >= :created_at', [':user_id' => $user_id,
                                    ':action' => 'zan', ':controller' => 'dish', ':created_at' => strtotime(date('Y-m-d'))]);
                                return ['success' => 1, 'message' => '取消点赞', 'data' => -1];
                            }
                        }
                    } elseif ('hate' == $data['data-do']) {
                        if (empty($user_log_hate)) { // 还没有进行踩
                            $re = $dish->updateCounters(['hate' => 1]);
                            if ($re) { // 更新用户操作-点赞记录
                                if ($model_log->load(['user_id' => $user_id, 'action' => 'hate', 'controller' => 'dish']) && $model_log->save()) {}
                                return ['success' => 1, 'message' => '点踩成功', 'data' => 1];
                            }
                        } else { // 踩过了
                            $re = $dish->updateCounters(['hate' => -1]);
                            if ($re) { // 更新用户操作-点赞记录
                                UserLog::deleteAll('user_id = :user_id and action = :action and controller = :controller and created_at >= :created_at', [':user_id' => $user_id,
                                    ':action' => 'hate', ':controller' => 'dish', ':created_at' => strtotime(date('Y-m-d'))]);
                                return ['success' => 1, 'message' => '取消踩', 'data' => -1];
                            }
                        }
                    }
                }
                break;
            default:
                break;
        }
    }




}