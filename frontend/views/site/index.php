<?php

use yii\helpers\Html;
$this->title = '点餐首页';
$this->params['title_sub'] = '点餐';
?>

<div class="c-layout-page">
    <section class="c-layout-revo-slider c-layout-revo-slider-4">
        <div class="tp-banner-container c-theme" style="height: 620px">
            <div class="tp-banner">
                <ul>
                    <!--BEGIN: SLIDE #1 -->
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="1000">
                        <img alt="" src="<?= Yii::getAlias('@web/static/images/backgrounds/bg-43.jpg');?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <div class="caption customin customout tp-resizeme" data-x="center" data-y="center" data-hoffset="" data-voffset="-50" data-speed="500" data-start="1000" data-customin="x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-easing="Back.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                            <h3 class="c-block-bordered c-font-48 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                TAKE THE WEB BY<br>
                                STORM WITH JANGO </h3>
                        </div>
                        <div class="caption lft tp-resizeme" data-x="center" data-y="center" data-voffset="110" data-speed="900" data-start="2000" data-easing="easeOutExpo">
                            <a href="#" class="c-action-btn btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase">Learn More</a>
                        </div>
                    </li>
                    <!--END -->
                    <!--BEGIN: SLIDE #2 -->
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="1000">
                        <img alt="" src="<?= Yii::getAlias('@web/static/images/backgrounds/bg-20.jpg');?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <div class="caption customin customout tp-resizeme" data-x="center" data-y="center" data-hoffset="" data-voffset="-50" data-speed="500" data-start="1000" data-customin="x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-easing="Back.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                            <h3 class="c-block-bordered c-font-48 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                JANGO IS OPTIMIZED<br>
                                TO EVERY DEVELOPMENT </h3>
                        </div>
                        <div class="caption lft tp-resizeme" data-x="center" data-y="center" data-voffset="110" data-speed="900" data-start="2000" data-easing="easeOutExpo">
                            <a href="#" class="c-action-btn btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase">Learn More</a>
                        </div>
                    </li>
                    <!--END -->
                    <!--BEGIN: SLIDE #3 -->
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="700" data-delay="6000" data-thumb="">
                        <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                        <img src="<?= Yii::getAlias('@web/static/images/revo_slide/blank.png');?>" alt="">
                        <div class="caption fulllscreenvideo tp-videolayer" data-x="0" data-y="0" data-speed="600" data-start="1000" data-easing="Power4.easeOut" data-endspeed="500" data-endeasing="Power4.easeOut" data-autoplay="true" data-autoplayonlyfirsttime="false" data-nextslideatend="true" data-videowidth="100%" data-videoheight="100%" data-videopreload="meta" data-videomp4="<?= Yii::getAlias('@web/static/video/video-2.mp4');?>" data-videowebm="" data-videocontrols="none" data-forcecover="1" data-forcerewind="on" data-aspectratio="16:9" data-volume="mute" data-videoposter="<?= Yii::getAlias('@web/static/images/revo_slide/blank.png');?>">
                        </div>
                        <div class="caption customin customout tp-resizeme" data-x="center" data-y="center" data-hoffset="" data-voffset="-30" data-speed="500" data-start="1000" data-customin="x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-easing="Back.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                            <h3 class="c-block-bordered-square c-font-55 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                Let us show you<br>
                                Unlimited possibilities </h3>
                        </div>
                        <div class="caption lft tp-resizeme" data-x="center" data-y="center" data-voffset="130" data-speed="900" data-start="2000" data-easing="easeOutExpo">
                            <a href="#" class="c-action-btn btn c-btn-square c-btn-border-2x c-btn-white c-btn-sbold c-btn-uppercase">Purchase</a>
                        </div>
                    </li>
                    <!--END -->
                </ul>
            </div>
        </div>
    </section>
</div>




<div class="container" style="padding: 50px 0;">
    <div class="page-content-inner">

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">饭店列表</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="mt-element-card mt-element-overlay">
                            <div class="row">
                                <?php if (empty($data)) {
                                    foreach ($data as $key => $vlaue) {
                                        echo $this->render('_item', ['model' => $vlaue]);
                                    }
                                } else {
                                    echo \Yii::t('app', '此处没有数据');
                                } ?>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1">
                                            <img src="<?= Yii::getAlias('@web/static/images/team2.jpg');?>" />
                                            <div class="mt-overlay">
                                                <ul class="mt-info">
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-magnifier"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-link"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-card-content">
                                            <h3 class="mt-card-name">Mark Anthony</h3>
                                            <p class="mt-card-desc font-grey-mint">Managing Director</p>
                                            <div class="mt-card-social">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-dribbble"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1 mt-scroll-down">
                                            <img src="<?= Yii::getAlias('@web/static/images/team2.jpg');?>" />
                                            <div class="mt-overlay mt-top">
                                                <ul class="mt-info">
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-magnifier"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-link"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-card-content">
                                            <h3 class="mt-card-name">Denzel Wash</h3>
                                            <p class="mt-card-desc font-grey-mint">Finance Director</p>
                                            <div class="mt-card-social">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-dribbble"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1 mt-scroll-up">
                                            <img src="<?= Yii::getAlias('@web/static/images/team3.jpg');?>" />
                                            <div class="mt-overlay">
                                                <ul class="mt-info">
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-magnifier"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-link"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-card-content">
                                            <h3 class="mt-card-name">David Goodman</h3>
                                            <p class="mt-card-desc font-grey-mint">Creative Director</p>
                                            <div class="mt-card-social">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-dribbble"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                    <div class="mt-card-item">
                                        <div class="mt-card-avatar mt-overlay-1 mt-scroll-left">
                                            <img src="<?= Yii::getAlias('@web/static/images/team4.jpg');?>" />
                                            <div class="mt-overlay">
                                                <ul class="mt-info">
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-magnifier"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn default btn-outline" href="javascript:;">
                                                            <i class="icon-link"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mt-card-content">
                                            <h3 class="mt-card-name">Lucy Ling</h3>
                                            <p class="mt-card-desc font-grey-mint">HR Director</p>
                                            <div class="mt-card-social">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="icon-social-dribbble"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<?php $this->beginBlock('index'); ?>
$(document).ready(function() {
    App.init(); // init core

    // init main slider
    var slider = $('.c-layout-revo-slider .tp-banner');
    var cont = $('.c-layout-revo-slider .tp-banner-container');
    var api = slider.show().revolution({
        delay: 15000,
        startwidth:1170,
        startheight: (App.getViewPort().width < App.getBreakpoint('md') ? 1024 : 620),
        navigationType: "hide",
        navigationArrows: "solo",
        touchenabled: "on",
        onHoverStop: "on",
        keyboardNavigation: "off",
        navigationStyle: "circle",
        navigationHAlign: "center",
        navigationVAlign: "center",
        fullScreenAlignForce:"off",
        shadow: 0,
        fullWidth: "on",
        fullScreen: "off",
        spinner: "spinner2",
        forceFullWidth: "on",
        hideTimerBar:"on",
        hideThumbsOnMobile: "on",
        hideNavDelayOnMobile: 1500,
        hideBulletsOnMobile: "on",
        hideArrowsOnMobile: "on",
        hideThumbsUnderResolution: 0,
        videoJsPath: "rs-plugin/videojs/",
    });
});
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['index'], \yii\web\View::POS_END); ?>