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
use yii\behaviors\TimestampBehavior;

class ShoppingCar extends ActiveRecord {

    public static function tableName() {

        return '{{%shopping_car}}';
    }

    public function behaviors() {

        return [
            'class' => TimestampBehavior::className()
        ];
    }

    public function rules() {

        return [
            [['id', 'user_id', 'hotel_id', 'dish_id', 'num', 'created_at', 'updated_at'], 'integer'],
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

    public function getDish() {

        return $this->hasOne(CookBook::className(), ['id' => 'dish_id']);
    }


    /**
     * 重载了load方法，因为我是手动构造的form表单
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load($data = [], $formName = null) {
        if (empty($data)) return false;
        $this->setAttributes($data);
        return true;
    }

}