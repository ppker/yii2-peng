<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/13
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Upload;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UploadController extends BaseController {

    public function actionUpload() {

        $model = new Upload();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                die('aaaa');
            } else {
                die('bbbbb');
                return false;
            }
        }
    }

}