<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false, 'class' => 'login-form', 'method' => 'post']); ?>

    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>Enter any username and password. </span>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Username" name="LoginForm[username]" required/> </div>
        <div class="col-xs-6">
            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="LoginForm[password]" required/> </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="rem-password">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="hidden" name="LoginForm[rememberMe]" value="0" />
                    <input type="checkbox" name="LoginForm[rememberMe]" value="1" /> Remember me
                    <span></span>
                </label>
            </div>
        </div>
        <div class="col-sm-8 text-right">
            <div class="forgot-password">
                <?= Html::a('Forgot Password', ['site/request-password-reset'], ['id' => 'forget-password', 'class' => 'forget-password']) ?>
            </div>
            <button class="btn green" type="submit">Sign In</button>
        </div>
    </div>
<?php ActiveForm::end(); ?>
