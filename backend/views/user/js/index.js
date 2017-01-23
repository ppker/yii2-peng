/**
 * author: ZhiPeng
 * date: 2017/1/23
 */

window.PAGE_ACTION = function() {
    "use strict";
    var init_limit = null, // 默认条件页面
        jisuan = null,// 计算
        tx_list = null, // 通讯录
        mark_look = null, // 查看备注
        cuishou_form = null, // 催收备注表单
        // form_search = null, // 搜索条件页面



        /*form_search = function() {

            var $form = null;
            $form = $("form#filter_bar");
            $form.submit(function(e){
                if(ZP.utils.isPassForm($form)){
                    ZP.api.yitian_overdue({
                        data: $form.serializeJson(),
                        successCallBack: function(result){
                            if(ZP.utils.isArray(result.data)){

                                ZP.utils.render("yitian/overdue.html", {
                                    list: result.data
                                },function(html){
                                    var table = $("#table");
                                    table.html(html);
                                    var t = table.DataTable({
                                        oLanguage: ZP.define.dataTableLan,
                                        bStateSave: ZP.define.dataTableStateSave,
                                        "stripeClasses": [ 'strip1', 'strip2'],
                                        dom: '<"html5buttons"B>lTfgitp',
                                        "scrollX": false,
                                        ScrollCollapse: true,
                                        "columnDefs": [
                                            { "visible": false, "targets": 17 }
                                        ],
                                        buttons: [
                                            {extend: 'csv', title: menu_name},
                                            {extend: 'excel', title: menu_name}
                                        ],
                                        "lengthMenu": [15, 30, 100],
                                        destroy: true

                                    });
                                });
                                jisuan();
                                tx_list();
                                mark_look()
                            }

                        },
                        failCallBack: ZP.utils.failCallBack
                    });
                }
                e.preventDefault();
            });
        };*/



    init_limit = function() {
        ZP.api.yitian_overdue({
            data: null,
            successCallBack:function(result){
                if(ZP.utils.isArray(result.data)){

                    ZP.utils.render("yitian/overdue.html", {
                        list: result.data
                    },function(html){
                        var table = $("#table");
                        table.html(html);
                        var t = table.DataTable({
                            oLanguage: ZP.define.dataTableLan,
                            bStateSave: ZP.define.dataTableStateSave,
                            "stripeClasses": [ 'strip1', 'strip2'],
                            dom: '<"html5buttons"B>lTfgitp',
                            "scrollX": false,
                            ScrollCollapse: true,

                            "columnDefs": [
                                { "visible": false, "targets": 17 }
                            ],

                            buttons: [
                                {extend: 'csv', title: menu_name},
                                {extend: 'excel', title: menu_name}
                            ],
                            "lengthMenu": [15, 30, 100],
                            destroy: true

                        });
                    });

                    // jisuan();
                    // tx_list();
                    // mark_look()

                }
            },
            failCallBack: ZP.utils.failCallBack
        });
    };

    mark_look = function() {

        $("#table").on("click","[actionrule=mark_look]",function(){

            var code = $(this).attr('actionid');
            var data = {};
            data.user_code = code;

            ZP.api.yitian_overdue_mark_look({
                data: data,
                successCallBack: function (result) {
                    if (result.data && ZP.utils.isArray(result.data)) { // 数据
                        ZP.utils.render("yitian/yitian_overdue_mark_look.html", {
                            list: result.data
                        },function(html){
                            var table = $("#table_mark_look");
                            table.html(html);
                            var t = table.DataTable({
                                // "order": [[ 0, "asc" ]],
                                oLanguage: ZP.define.dataTableLan,
                                bStateSave: ZP.define.dataTableStateSave,
                                "stripeClasses": [ 'strip1', 'strip2'],
                                "ordering": false,
                                dom: 'Tgtpi',
                                "scrollX": false,
                                ScrollCollapse: true,
                                "lengthMenu": [3, 25, 210],
                                destroy: true
                            });
                        });
                    }
                    $("#user_id").val(code);
                    $("#cs_status1 option[text='请选择']").attr("selected", true);

                    $("#cuishou_text").val("");
                    $("#mark_lookModal").modal('show');




                },
                // failCallBack: ZP.utils.failCallBack
            });

        });

    };

    cuishou_form = function() {

        var $form = null;
        $form = $("form#cuishou_form");
        $form.submit(function(e){
            //表单验证
            if(ZP.utils.isPassForm($form)){

                ZP.api.yitian_overdue_cuishou_form({
                    data: $form.serializeJson(),
                    successCallBack: function(result){
                        $.messager.alert(result.message);
                        $("#mark_lookModal").modal('hide');
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
            e.preventDefault();
        });
    };

    tx_list = function() { // 查看通信录

        $("#table").on("click","[actionrule=tx_list]",function(){

            var code = $(this).attr('actionid');
            var data = {};
            data.user_code = code;

            ZP.api.yitian_overdue_txlist({
                data: data,
                successCallBack: function (result) {
                    if (result.data && ZP.utils.isArray(result.data)) { // 数据
                        ZP.utils.render("yitian/yitian_overdue_txlist.html", {
                            list: result.data
                        },function(html){
                            var table = $("#table_txl");
                            table.html(html);
                            var t = table.DataTable({
                                // "order": [[ 0, "asc" ]],
                                oLanguage: ZP.define.dataTableLan,
                                bStateSave: ZP.define.dataTableStateSave,
                                "stripeClasses": [ 'strip1', 'strip2'],
                                "ordering": false,
                                dom: 'Tfgtpi',
                                "scrollX": false,
                                ScrollCollapse: true,
                                "lengthMenu": [15, 30, 100],
                                destroy: true
                            });
                        });
                    }
                    $("#tx_listModal").modal('show');
                },
                failCallBack: ZP.utils.failCallBack
            });

        });

    };




    jisuan = function() { // 计算

        $("#table").on("click","[actionrule=jisuan]",function(){

            $("#jisuanModal").modal('show');
            $("#jisuanModal").on("click", "button#js_jisuan", function(e) {
                e.preventDefault();
                var $date = $("#js_hkr").val();
                alert($date);
            });


            /*var id = $(this).attr('actionid');
             var data = {};
             data.id = id;
             ZP.api.roleInfo({
             data: data,
             successCallBack:function(result){
             if(result.data){
             $("#addModal .modal-header h4").text("编辑角色");
             $("input[name=name]").val(result.data.name);
             $("input[name=pid]").val(result.data.pid);

             $("input[name=rule_id]").val(result.data.rule_id);
             var t_status = result.data.status;
             $("input[type=radio][name=status][value=" + t_status + "]").attr("checked", true);
             $("input[name=remark]").val(result.data.remark);
             $("#addForm").append("<input type='hidden' name='id' value=" + id + " />");
             // $("#addForm button#btn-save").attr("id", "edit-save");

             }
             $("#addModal").modal('show');
             },
             failCallBack: ZP.utils.failCallBack
             });*/

        });



    };




    return {
        init: function (){
            init_limit();
            ZP.utils.target_timedate();
            // cuishou_form();
            // form_search();
        }
    };


}