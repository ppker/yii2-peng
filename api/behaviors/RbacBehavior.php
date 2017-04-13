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

    /**
     * 已登录用户的公共api
     * @var array
     */
    public $allowActions = []; // ['site/login', 'site/*']

    public $guestActions = []; //


    public function events() {

        return [
            Controller::EVENT_BEFORE_ACTION => 'rbacAction'
        ];
    }

    public function rbacAction($event) {


        $access_token = Yii::$app->request->post((new QueryParamAuth)->tokenParam);
        $user = User::findOne(['username' => $access_token]);

        $base_rule = $event->action->getUniqueId();
        $rule = Yii::$app->id . "/" . $base_rule;

        if (!empty($access_token) && !empty($user)) {
            $event->isValid = true; // 继续执行
            $allowActions = array_unique(array_merge($this->allowActions, $this->guestActions));

            foreach ($allowActions as $allow) {
                if ('*' == substr($allow, -1)) {
                    if (0 === strpos($base_rule, rtrim($allow, '*'))) return true;
                } else {
                    if ($base_rule == $allow) return true;
                }
            }
            if (Menu::checkRule($rule, $user)){
                return true;
            }
        } else {
            foreach($this->guestActions as $allow) {
                if ('*' == substr($allow, -1)) {
                    if (0 === strpos($base_rule, rtrim($allow, '*'))) return true;
                } else {
                    if ($base_rule == $allow) return true;
                }
            }
        }
        $event->isValid = false;
        $this->denyAccess();

    }

    protected function denyAccess() {

        echo json_encode(['success' => 0, 'message' => '您还没有登录', 'data' => '']);
        return;
        // throw new ForbiddenHttpException(Yii::t('yii', 'you are not allowed to perform this action.'));
    }

}