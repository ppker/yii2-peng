/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/24
 */
window.PAGE_ACTION = function() {
    "use strict";

    var init_first = null, // 默认条件页面
        btn_submit = null;

    init_first = function() {
        $(function() {
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
        })
    };

    return {
        init: function (){
            init_first();
        }
    };
}