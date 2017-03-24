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
<body class="page-container-bg-solid">
<?php $this->beginBody() ?>

<div class="page-wrapper">
    <div class="page-wrapper-row">
        <div class="page-wrapper-top">
            <!-- BEGIN HEADER -->
            <?= $this->render('@app/views/layouts/public/header.php', ['data' => '']); ?>
            <!-- END HEADER -->
        </div>
    </div>

    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <!-- BEGIN PAGE CONTENT BODY -->
                    <!-- BEGIN PAGE CONTENT BODY -->
                    <div class="page-content">
                        <!--<div class="container">-->
                            <!-- BEGIN PAGE BREADCRUMBS -->
                            <!--<ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Dashboard</span>
                                </li>
                            </ul>-->
                            <!-- END PAGE BREADCRUMBS -->
                            <!-- BEGIN PAGE CONTENT INNER -->
                        <!--</div>-->
                        <?= $content ?>

                            <!-- END PAGE CONTENT INNER -->



                    </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->




                <!-- BEGIN QUICK SIDEBAR -->
                <?= $this->render('@app/views/layouts/public/quick_sidebar.php', ['data' => '']); ?>
                <!-- END QUICK SIDEBAR -->


            </div>
            <!-- END CONTAINER -->
        </div>
    </div>

    <!-- BEGIN FOOTER -->
    <?= $this->render('@app/views/layouts/public/footer.php', ['data' => '']); ?>
    <!-- END FOOTER -->

</div>


<nav class="quick-nav">
    <a class="quick-nav-trigger" href="#0">
        <span aria-hidden="true"></span>
    </a>
    <ul>
        <li>
            <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank" class="active">
                <span>Purchase Metronic</span>
                <i class="icon-basket"></i>
            </a>
        </li>
        <li>
            <a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/reviews/4021469?ref=keenthemes" target="_blank">
                <span>Customer Reviews</span>
                <i class="icon-users"></i>
            </a>
        </li>
        <li>
            <a href="http://keenthemes.com/showcast/" target="_blank">
                <span>Showcase</span>
                <i class="icon-user"></i>
            </a>
        </li>
        <li>
            <a href="http://keenthemes.com/metronic-theme/changelog/" target="_blank">
                <span>Changelog</span>
                <i class="icon-graph"></i>
            </a>
        </li>
    </ul>
    <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>



<!-- END THEME LAYOUT SCRIPTS -->
<?php $this->endBody() ?>
</body>

<script type="text/javascript">
    (window.PAGE_ACTION && $(window).ready(window.PAGE_ACTION().init));
</script>

</html>
<?php $this->endPage() ?>
