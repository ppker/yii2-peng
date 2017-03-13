/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/9
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_limit = null, // 默认条件页面
        img_upload = null, // 图片上传
        btn_add = null,
        btn_submit = null,
        btn_submit_bak = null,
    // btn_all_del = null, // 批量删除的按钮
        btn_edit = null,
        btn_reset = null,
        btn_auth = null,
        btn_del = null; // 单个删除的按钮

    init_limit = function() {
        ZP.api.cook_index({
            data: null,
            successCallBack:function(result){

                if(ZP.utils.isArray(result.data)){

                    ZP.utils.render("cook/cook_index.html", {
                        list: result.data
                    },function(html){
                        var table = $("#table");
                        table.html(html);
                        var t = table.DataTable({
                            // dom: '<"html5buttons"B>lTfgitp',
                            "order": [[ 0, "asc" ]],
                            oLanguage: ZP.define.dataTableLan,
                            bStateSave: ZP.define.dataTableStateSave,
                            // "stripeClasses": [ 'strip1', 'strip2'],
                            "ordering": true,
                            // dom: 'Tfgtpi',
                            scrollX: false,
                            ScrollCollapse: true,
                            buttons: [
                                { extend: 'print', className: 'btn dark btn-outline' },
                                { extend: 'copy', className: 'btn red btn-outline' },
                                { extend: 'pdf', className: 'btn green btn-outline' },
                                { extend: 'excel', className: 'btn yellow btn-outline ' },
                                { extend: 'csv', className: 'btn purple btn-outline ' },
                                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
                            ],
                            responsive: true,
                            "lengthMenu": [15, 30, 100],
                            destroy: true
                        });

                        $('#sample_3_tools > li > a.tool-action').on('click', function() {
                            var action = $(this).attr('data-action');
                            t.button(action).trigger();
                        });
                        // 全选
                        ZP.utils.init_page_module();
                        ZP.utils.btn_all_del('User_del');
                        btn_add(); // 弹出模态框
                        btn_submit(); // 绑定提交的表单
                        btn_del();
                        btn_edit();
                        btn_reset();
                        btn_auth();
                        img_upload();
                    });


                }
            },
            failCallBack: ZP.utils.failCallBack
        });
    };

    btn_add = function() {
        $("#btn_add").on('click', function() {
            $("#addModal").modal('show');
        });
    };

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



    btn_submit = function() {
        var $form = null;
        $form = $("form#addForm");
        $form.submit(function(e){
            //表单验证
            if(ZP.utils.isPassForm($form)){
                $("#addModal").modal('hide');
                ZP.api.User_add({
                    data: $form.serializeJson(),
                    successCallBack: function(result){
                        ZP.utils.alert_warning(result.message, true);
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
            e.preventDefault();
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

    img_upload = function () { // 图片上传

        $('#fileupload').fileupload({
            url: "/backend/web/upload/upload",
            disableImageResize: false,
            autoUpload: false,
            maxNumberOfFiles: 1,
            disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            always: function (e, data) {
                $(this).removeClass('fileupload-processing');
            }
        });

        // Enable iframe cross-domain access via redirect option:
        $('#fileupload').fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
            )
        );

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                        new Date())
                    .appendTo('#fileupload');
            });
        }
        $(this).addClass('fileupload-processing');
    };





    return {
        init: function (){
            init_limit();
        }
    };


}