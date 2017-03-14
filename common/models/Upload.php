<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/13
 */

namespace common\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class Upload extends Model{

    public $imageFile;
    public $save_path = "/upload/";

    public function rules() {

        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg', 'maxFiles' => 1],
        ];
    }

    public function upload() {


        if ($this->validate()) {

            var_dump($this->save_path . $this->imageFile->baseName . "." . $this->imageFile->extension);die;
            $this->imageFile->saveAs($this->save_path . $this->imageFile->baseName . "." . $this->imageFile->extension);
            return true;
        } else return false;
    }

}