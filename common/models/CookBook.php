<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/18
 */

namespace common\models;

use Yii;
use common\components\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class CookBook extends ActiveRecord {

    public function behaviors() {

        return [
            'class' => TimestampBehavior::className()
        ];
    }

    public static function tableName() {

        return '{{%cookbook}}';
    }

    public function rules() {

        return [
            [['id', 'res_id', 'price', 'zan', 'hate', 'star', 'status', 'created_at', 'updated_at'], 'integer'],
            [['mark', 'photo'], 'string', 'max' => 255],
            [['name', 'photo'], 'string', 'max' => 60]
        ];
    }

    public function attributeLabels() {

        return [
            'id' => 'ID',
            'res_id' => 'Res_id',
            'name' => 'Name',
            'price' => 'Price',
            'mark' => 'Mark',
            'zan' => 'Zan',
            'hate' => 'Hate',
            'photo' => 'Photo',
            'star' => 'Star',
            'status' => 'Status',
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