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
use yii\behaviors\TimestampBehavior;

class Restaurant extends ActiveRecord {

    public function behaviors() {

        return [
            'class' => TimestampBehavior::className()
        ];
    }

    public static function tableName() {

        return '{{%restaurant}}';
    }

    public function rules() {

        return [
            [['id', 'star', 'zan', 'hate', 'status', 'created_at', 'updated_at'], 'integer'],
            [['open_time', 'close_time'], 'string', 'max' => 5],
            [['address', 'photo', 'mark'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 12],
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
