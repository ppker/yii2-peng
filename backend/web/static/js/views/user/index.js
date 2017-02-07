/**
 * author: ZhiPeng
 * date: 2017/1/23
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_limit = null, // 默认条件页面
        btn_add = null,
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
                    });


                }
            },
            failCallBack: ZP.utils.failCallBack
        });
    };


    btn_add = function() {
        $("#btn_add").on('click', function() {

        });
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