<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/15
 */

namespace common\models;

use Yii;
use common\components\db\ActiveRecord;

class Restaurant extends ActiveRecord {

    public static function tableName() {

        return '{{%restaurant}}';
    }

    public function rules() {

        return [
            [['id', 'star', 'zan', 'hate', 'status'], 'integer'],
            [['open_time', 'close_time'], 'string', 'max' => 5],
            [['address'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels() {

        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'star' => 'Star',
            'zan' => 'Zan',
            'hate' => 'Hate',
            'photo' => 'photo',
            'open_time' => 'open_time',
            'close_time' => 'close_time',
            'mark' => 'mark',
            'status' => 'status',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at'
        ];
    }
}
