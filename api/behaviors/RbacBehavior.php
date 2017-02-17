<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/2/12
 */

namespace api\behaviors;

use Yii;
use yii\base\Controller;
use backend\models\Menu;
use yii\web\ForbiddenHttpException;
use yii\base\Behavior;
use yii\filters\auth\QueryParamAuth;
use common\models\User;

class RbacBehavior extends Behavior {

    public $allowActions = [];
    public function events() {

        return [
            Controller::EVENT_BEFORE_ACTION => 'rbacAction'
        ];
    }

    public function rbacAction($event) {

        $access_token = Yii::$app->request->post((new QueryParamAuth)->tokenParam);
        $user = User::findOne(['username' => $access_token]);

        if (!empty($access_token) && !empty($user)) {
            $event->isValid = true; // 继续执行


            $rule = $event->action->getUniqueId();

            $rule = Yii::$app->id . "/" . $rule;
            foreach ($this->allowActions as $allow) {
                if ('*' == substr($allow, -1)) {
                    if (0 === strpos($rule, rtrim($allow, '*'))) return true;
                } else {
                    if ($rule == $allow) return true;
                }
            }
            if (Menu::checkRule($rule, $user)){
                return true;
            }
        }
        $event->isValid = false;
        $this->denyAccess();

    }

    protected function denyAccess() {

        throw new ForbiddenHttpException(Yii::t('yii', 'you are not allowed to perform this action.'));
    }

}