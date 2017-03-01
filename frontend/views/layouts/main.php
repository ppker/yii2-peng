<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/28
 * Project: Cat Visual
 */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\EndAsset;

EndAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="<?= Yii::$app->language; ?>" />
    <title><?= $this->title; ?> | <?= \Yii::$app->setting->get('siteName') ?> | <?= \Yii::$app->setting->get('siteTitle') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="<?= Yii::$app->setting->get('siteKeyword'); ?>"
          name="description" />
    <?= Html::csrfMetaTags() ?>
    <meta content="" name="author" />
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?=Yii::getAlias('@web/favicon.ico'); ?>" />
</head>
<!-- END HEAD -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-full-width">
<?php $this->beginBody() ?>

<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <?= $this->render('@app/views/layouts/public/header.php', ['data' => '']); ?>
    <!-- END HEADER -->
    <div class="clearfix"> </div>
    <!-- BEGIN FOOTER -->
    <?= $this->render('@app/views/layouts/public/footer.php', ['data' => '']) ?>
    <!-- END FOOTER -->
</div>

<!-- END THEME LAYOUT SCRIPTS -->
<?php $this->endBody() ?>
</body>



</html>
<?php $this->endPage() ?>
