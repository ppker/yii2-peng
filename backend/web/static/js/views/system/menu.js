/**
 * author: ZhiPeng
 * date: 2017/2/20
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_limit = null, // 默认条件页面
        btn_edit = null,
        btn_reset = null,
        btn_auth = null,
        btn_del = null; // 单个删除的按钮

    btn_edit = function() { // 编辑操作
        $("table tr .btn-group li").on("click", "a[actionrule='edit']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.system_menu_get({
                    data: {id: $id},
                    successCallBack: function(result){

                        $("#addModal h4.modal-title").text('菜单编辑');
                        $("#addModal input[name='id']").val(result.data.id);
                        $("#addModal input[name='title']").val(result.data.title);
                        $("#addModal input[name='sort']").val(result.data.sort);
                        var hide = result.data.hide;
                        $("#addModal input[name='hide'][value=" + hide + "]").attr("checked", true);
                        $("#addModal input[name='url']").val(result.data.url);
                        $("#addModal input[name='group']").val(result.data.group);
                        var status = result.data.status;
                        $("#addModal input[name='status'][value=" + status + "]").attr("checked", true);
                        var pid = result.data.pid;
                        $("#addModal selected[name='pid'][value=" + pid + "]").attr("selected", true);
                        $("#addModal").modal('show');
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };


    init_limit = function() {
        ZP.utils.default_list({
            'api_url': 'system_menu', // list的api
            'template_path': 'system/menu_index.html',
            'dataTable': $.extend(true, {}, ZP.utils.default_dataTable_list, {}),
            'all_del_api': 'system_menu_del',
            'add_api': 'system_menu_add',
            'init_form_api': {'api': 'init_form_api', 'id': 'pid_id'}, // 需要对表单进行数据初始化操作
            'btn_edit': btn_edit,
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