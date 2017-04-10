<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/24
 * Project: Cat Visual
 */

use yii\widgets\ActiveForm;
use \yii\helpers\Url;

$this->title = '点餐订单管理';
$this->params['title_sub'] = '管理用户点餐订单信息';
?>

<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">用户点餐订单管理</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn blue btn-outline btn-circle" href="javascript:;" id="btn_add">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> 新增点餐订单</span>
                        </a>
                        <a class="btn red btn-outline btn-circle" href="javascript:;" actionrule="delete" id="btn_all_del">
                            <i class="fa fa-remove"></i>
                            <span class="hidden-xs"> 删除点餐订单</span>
                        </a>
                    </div>


                    <div class="btn-group">
                        <a class="btn green btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i>
                            <span class="hidden-xs"> 设置 </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" id="sample_3_tools">
                            <li>
                                <a href="javascript:;" data-action="0" class="tool-action">
                                    <i class="icon-printer"></i> Print</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="1" class="tool-action">
                                    <i class="icon-check"></i> Copy</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="2" class="tool-action">
                                    <i class="icon-doc"></i> PDF</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="3" class="tool-action">
                                    <i class="icon-paper-clip"></i> Excel</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="4" class="tool-action">
                                    <i class="icon-cloud-upload"></i> CSV</a>
                            </li>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="table">

                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>

<!--模态框-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">新增点餐订单记录</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" role="form" data-toggle="validator" class="form-horizontal">
                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                    <input type="hidden" name="id" value="" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id" class="control-label col-sm-3">姓名</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="user_id" id="select_user_id" data-size="8" required>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hotel_id" class="control-label col-sm-3">餐厅</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="hotel_id" id="select_hotel_id" data-size="8" required>

                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dish_id" class="control-label col-sm-3">菜肴</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="dish_id" id="select_dish_id" data-size="8" required>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="num" class="control-label col-sm-3">份数</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入份数" class="form-control" pattern="^[\d]{1,6}" data-error="请填写数字" name="num" required >
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 text-center">
                            <button type="button" class="btn default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn green" id="btn-save">添加</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>