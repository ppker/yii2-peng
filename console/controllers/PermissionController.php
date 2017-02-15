<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/13
 * Project: Cat Visual
 */

namespace console\controllers;
use Yii;

class PermissionController extends BaseController {


    public function actionIndex() {

        $auth = Yii::$app->authManager;

        $manager = $auth->createRole('manager');
        $auth->add($manager);
        echo "ok";
        exit;

        /*$admin = $auth->createRole('administer');
        $auth->add($admin);*/



        $index = $auth->createPermission("app-api/user/user_reset");
        $index->description = "创建了{app-api/user/user_reset}的权限";
        $auth->add($index);

        $admin = $auth->getRole("administer");
        $auth->addChild($admin, $index);
        echo "ok\n";
        return 0;




        $index = $auth->createPermission("app-api/user/user_get");
        $index->description = "创建了{app-api/user/user_get}的权限";
        $auth->add($index);

        $admin = $auth->getRole("administer");
        $auth->addChild($admin, $index);
        echo "ok\n";
        return 0;


        $index = $auth->createPermission("app-api/user/index");
        $index->description = "创建了{app-api/user/index}的权限";
        $auth->add($index);


        $add = $auth->createPermission("app-api/user/user_add");
        $add->description = "创建了{app-api/user/user_add}的权限";
        $auth->add($add);

        $del = $auth->createPermission("app-api/user/user_del");
        $del->description = "创建了{app-api/user/user_del}的权限";
        $auth->add($del);

        $admin = $auth->getRole("administer");
        $auth->addChild($admin, $index);
        $auth->addChild($admin, $add);
        $auth->addChild($admin, $del);
        // $message = $this->ansiFormat("权限刷新成功!", Console::FG_YELLOW);
        // $this->stdout("Hello?\n", BaseController::BOLD);
        echo "权限刷新成功!";
        return 0;
    }

}