<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/7
 * Project: Cat Visual
 */

namespace backend\behaviors;

use Yii;
use yii\base\Controller;
use backend\models\Menu;
use yii\web\ForbiddenHttpException;
use yii\base\Behavior;

class RbacBehavior extends Behavior {

    public $allowActions = [];
    public function events() {

        return [
            Controller::EVENT_BEFORE_ACTION => 'rbacAction'
        ];
    }

    public function rbacAction($event) {
        
        $event->isValid = true; // 继续执行
        $rule = $event->action->getUniqueId();
        foreach ($this->allowActions as $allow) {
            if ('*' == substr($allow, -1)) {
                if (0 === strpos($rule, rtrim($allow, '*'))) return true;
            } else {
                if ($rule == $allow) return true;
            }
        }
        if (Menu::checkRule($rule)) return true;
        $event->isValid = false;
        $this->denyAccess();

    }

    protected function denyAccess() {

        if (\Yii::$app->user->getIsGuest()) {
            \Yii::$app->user->loginRequired();
        } else throw new ForbiddenHttpException(Yii::t('yii', 'you are not allowed to perform this action.'));
    }

}