/**
 * author: ZhiPeng
 * date: 2017/2/20
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_limit = null, // 默认条件页面
        btn_add = null,
        btn_submit = null,
        btn_edit = null,
        btn_reset = null,
        btn_auth = null,
        btn_del = null; // 单个删除的按钮

    init_limit = function() {
        ZP.utils.default_list({
            'api_url': 'system_menu',
            'template_path': 'system/menu_index.html',
            'dataTable': $.extend(true, {}, ZP.utils.default_dataTable_list, {}),
            'all_del_api': 'system_menu_del',
            'add_api': 'system_menu_add',
        });
    };

    // btn_del();
    // btn_edit();
    // btn_reset();
    // btn_auth();


    btn_auth = function() { // 用户授权
        $("table tr .btn-group li").on("click", "a[actionrule='auth']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.User_auth({
                    data: {id: $id},
                    successCallBack: function(result){
                        $("#ruleModal div.mt-radio-list").empty();
                        var $radio = '';
                        if (ZP.utils.isObject(result.data)) {
                            $.each(result.data.all, function(i, v) {
                                if ($.inArray(v.name, [result.data.now[0]])> -1) {
                                    $radio += '<label class="mt-radio mt-radio-outline"><input type="radio" name="param" value="' + v.name +  '" checked'  + '><span></span>' + v.name + '('+ v.description + ')' + '</label>';
                                } else $radio += '<label class="mt-radio mt-radio-outline"><input type="radio" name="param" value="' + v.name + '"><span></span>' + v.name + '('+ v.description + ')' + '</label>';
                            });
                        }
                        $("input#auth_user_id").val($id);
                        $("#ruleModal div.mt-radio-list").append($radio);
                        $("#ruleModal").modal('show');

                        // 对表单事件进行监听
                        var $form = null;
                        $form = $("form#authForm");
                        $form.submit(function(e){
                            //表单验证
                            if(ZP.utils.isPassForm($form)){
                                $("#ruleModal").modal('hide');
                                ZP.api.User_auth({
                                    data: $form.serializeJson(),
                                    successCallBack: function(result){
                                        ZP.utils.alert_warning(result.message, true, true);
                                    },
                                    failCallBack: ZP.utils.failCallBack
                                });
                            }
                            e.preventDefault();
                        });
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };


    btn_edit = function() { // 编辑操作
        $("table tr .btn-group li").on("click", "a[actionrule='edit']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.User_get({
                    data: {id: $id},
                    successCallBack: function(result){
                        console.log(result.data);
                        $("#addModal h4.modal-title").text('用户编辑');
                        $("#addModal input[name='username']").val(result.data.username).after("<input type='hidden' name='id' value=" + $id + ">");
                        $("#addModal select#role_id").val(result.data.status);
                        $("#addModal label[for='user_pass']").parent().remove();
                        var sex = result.data.sex;
                        $("#addModal input[name='sex'][value=" + sex + "]").attr("checked", true);
                        $("#addModal input[name='signature']").val(result.data.signature);
                        $("#addModal input[name='email']").val(result.data.email);
                        $("#addModal").modal('show');
                        // ZP.utils.alert_warning(result.message, true);
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };

    btn_reset = function() { // 重置密码的操作
        $("table tr .btn-group li").on("click", "a[actionrule='reset']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.User_reset({
                    data: {id: $id},
                    successCallBack: function(result){
                        ZP.utils.alert_warning(result.message, true);
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };




    btn_del = function() { // 单个删除按钮

        $("table tr .btn-group li").on("click", "a[actionrule='del']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.User_del({
                    data: {id: $id},
                    successCallBack: function(result){
                        ZP.utils.alert_warning(result.message, true);
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };

    return {
        init: function (){
            init_limit();
        }
    };


}