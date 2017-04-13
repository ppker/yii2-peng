<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/4/13
 */

namespace common\models;

use Yii;
use common\components\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class UserLog extends ActiveRecord {

    public function behaviors() {

        return [
            'class' => TimestampBehavior::className()
        ];
    }

    public static function tableName() {

        return '{{%user_log}}';
    }

    public function rules() {

        return [
            [['id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['action', 'controller', 'value'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {

        return [
            'id' => 'ID',
            'user_id' => 'User_id',
            'action' => 'Action',
            'controller' => 'Controller',
            'value' => 'Value',
            'created_at' => 'Created_at',
            'updated_at' => 'Updated_at'
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