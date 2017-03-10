<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/9
 */

use yii\helpers\Url;

$this->title = '用户账号';
$this->params['title_sub'] = '管理用户账号信息';

// 加载页面级资源
\backend\assets\UploadAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">管理餐厅信息</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn blue btn-outline btn-circle" href="javascript:;" id="btn_add">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> 新增餐厅</span>
                        </a>
                        <a class="btn red btn-outline btn-circle" href="javascript:;" actionrule="delete" id="btn_all_del">
                            <i class="fa fa-remove"></i>
                            <span class="hidden-xs"> 删除餐厅</span>
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
                <h4 class="modal-title">新增餐厅</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" role="form" data-toggle="validator" class="form-horizontal">
                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label col-sm-4">餐厅名称</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="请输入餐厅名称" class="form-control" name="name" minlength="3" data-remote="<?= Url::toRoute(['site/check_hotel']) ?>" data-remote-error="餐厅名称已被注册" required />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label col-sm-4">餐厅电话</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="请输入餐厅电话" class="form-control" name="phone" minlength="6" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="open_time" class="control-label col-sm-4">开门时间</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="比如：08:30" class="form-control" name="opentime" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="close_time" class="control-label col-sm-4">打烊时间</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="比如：02:00" class="form-control" name="close_time" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="control-label col-sm-4">餐厅状态</label>
                            <div class="col-sm-8">
                                <select class="form-control"  name="status" id="hotel_status" required>
                                    <option value="1" selected>营业</option>
                                    <option value="0">停业整改</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="address" class="control-label col-sm-4">餐厅地址</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="请输入餐厅地址" class="form-control"  name="address" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="star" class="control-label col-sm-4">推荐星数</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="默认0，可不填" class="form-control"  name="star" pattern="^[\d]{1}" data-error="0-9的数字" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zan" class="control-label col-sm-4">点赞次数</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="默认0，可不填" class="form-control"  name="zan" pattern="^[\d]+" data-error="必须是数字" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hate" class="control-label col-sm-4">反对次数</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="默认0，可不填" class="form-control"  name="hate" pattern="^[\d]+" data-error="必须是数字" />
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mark" class="control-label col-sm-2">备注</label>
                            <div class="col-sm-10">
                                <textarea name="mark" class="form-control" placeholder="餐厅简介" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--上传照片-->

                    <form id="image_upload" action="<?= Url::to('/api/web/file/upload'); ?>" method="POST" enctype="multipart/form-data">

                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-7">
                                <span class="btn green fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span> 添加文件... </span>
                                    <input type="file" name="files[]" multiple=""> </span>

                                <span class="fileupload-process"> </span>
                            </div>
                            <!-- The global progress information -->
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"> </div>
                                </div>
                                <!-- The extended global progress information -->
                                <div class="progress-extended"> &nbsp; </div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped clearfix">
                            <tbody class="files"> </tbody>
                        </table>
                    </form>


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




<div class="modal fade" id="ruleModal" tabindex="-1" role="dialog" aria-labelledby="ruleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">用户授权</h4>
            </div>
            <div class="modal-body">
                <form id="authForm" role="form" data-toggle="validator" class="form-horizontal">
                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                    <input type="hidden" name="user_id" id="auth_user_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user_param" class="control-label col-sm-3" style="padding-top: 0;">用户组</label>
                            <div class="mt-radio-list col-sm-9">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 text-center">
                            <button type="button" class="btn default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn green" id="btn-auth-save">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
