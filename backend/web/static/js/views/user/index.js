/**
 * author: ZhiPeng
 * date: 2017/1/23
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_limit = null, // 默认条件页面
        btn_add = null,
        btn_submit = null,
        btn_all_del = null; // 批量删除的按钮


    init_limit = function() {
        ZP.api.user_index({
            data: null,
            successCallBack:function(result){

                if(ZP.utils.isArray(result.data)){

                    ZP.utils.render("user/user_index.html", {
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
                            "scrollX": false,
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
                        ZP.utils.btn_all_del();
                        btn_add(); // 弹出模态框
                        btn_submit(); // 绑定提交的表单
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

    btn_submit = function() {

        var form = $('#addForm');
        var error = $('.alert-danger', form);
        var success = $('.alert-success', form);
        var rule = {
            rules: {
                username: {
                    minlength: 3,
                    required: true
                },
                sex: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                status: {
                    required: true,
                },
                signature: {
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
            },
        };
        form.validate($.extend(ZP.utils.form_validation, rule));
    };





    return {
        init: function (){
            init_limit();
            //ZP.utils.target_timedate();
            // cuishou_form();
            // form_search();
        }
    };


}