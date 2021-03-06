<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\models\Restaurant;
use common\models\CookBook;


/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'check_user', 'check_role', 'check_hotel', 'check_dish'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {

        if (parent::beforeAction($action)) {

            if (('login' == $action->id || 'error' == $action->id) && Yii::$app->user->isGuest)
                $this->layout = 'main-login';
            return true;
        } return false;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        /*$auth = Yii::$app->authManager;
        $go = $auth->createPermission("app-api/user/user_add");
        $go->description = "创建了 app-api/user/user_add 的权限";
        $auth->add($go);

        $del = $auth->createPermission("app-api/user/user_del");
        $del->description = "创建了 app-api/user/user_del 的权限";
        $auth->add($del);

        $admin = $auth->getRole('administer');
        $auth->addChild($admin, $go);
        $auth->addChild($admin, $del);
        die('ssss');*/
        

        /*$auth = Yii::$app->authManager;
        $go = $auth->createPermission("site/go");
        $go->description = '创建了 site/go 的权限';
        $auth->add($go);

        $index = $auth->createPermission("site/index");
        $index->description = '创建了 site/index 的权限';
        $auth->add($index);



        $admin = $auth->createRole('administer');
        $auth->add($admin);
        $auth->addChild($admin, $go);
        $auth->addChild($admin, $index);

        $auth->assign($admin, 1);
        die('ssss');*/

        // var_dump($this->layout);die;
        return $this->render('index');
    }



    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $username = Yii::$app->session->has('username');
            if ($username) Yii::$app->session->remove('username');
            else Yii::$app->session->set('username', Yii::$app->request->post('LoginForm')['username']);
            return $this->goBack();
        } else {
            // $this->layout = 'main-login';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * 创建权限
     * @param $name
     */
    public function createPermission($name) {

        $auth = Yii::$app->authManager;
        $createPost = $auth->createPermission($name);
        $createPost->description = '创建了 ' . $name . ' 权限';
        $auth->add($createPost);
    }

    /**
     * 创建角色
     * @param $name
     */
    public function createRole($name) {

        $auth = Yii::$app->authManager;
        $role = $auth->createRole($name);
        $role->description = '创建了 ' . $name . ' 角色';
        $auth->add($role);
    }

    public function actionCheck_user() {

        $username = Yii::$app->request->getQueryParam('username');
        $user = User::find()->where(['username' => $username])->exists();
        Yii::$app->response->statusCode = 200;
        if ($user) {
            return json_encode(['state' => 0]);
        } else return json_encode(['state' => 1]);
    }

    public function actionCheck_hotel() {

        $hotelname = Yii::$app->request->getQueryParam('name');
        $re = Restaurant::find()->where(['name' => $hotelname])->exists();
        Yii::$app->response->statusCode = 200;
        if ($re) {
            return json_encode(['state' => 0]);
        } else return json_encode(['state' => 1]);
    }



    public function actionCheck_role() {

        $name = Yii::$app->request->getQueryParam('name');
        $role = Yii::$app->authManager->getRole($name);
        Yii::$app->response->statusCode = 200;
        if ($role) {
            return json_encode(['state' => 0]);
        } else return json_encode(['state' => 1]);
    }

    public function actionCheck_dish() {

        $name = Yii::$app->request->getQueryParam('name');
        $re = CookBook::find()->where(['name' => $name])->exists();
        Yii::$app->response->statusCode = 200;
        if ($re) {
            return json_encode(['state' => 0]);
        } else return json_encode(['state' => 1]);
    }



}
