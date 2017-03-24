<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/24
 * Project: Cat Visual
 */

namespace common\models;

use Yii;
use common\components\db\ActiveRecord;

class ShoppingCar extends ActiveRecord {

    public static function tableName() {

        return '{{%shopping_car}}';
    }

    public function rules() {

        return [
            [['id', 'user_id', 'hotel_id', 'dish_id', 'num', 'created_at', 'updated_at'], 'integer']
        ];
    }

    public function attributeLabels() {

        return [
            'id' => 'ID',
            'user_id' => 'User_id',
            'hotel_id' => 'Hotel_id',
            'dish_id' => 'Dish_id',
            'num' => 'Num',
            'created_at' => 'Created_at',
            'updated_at' => 'Updated_at',
        ];
    }

}