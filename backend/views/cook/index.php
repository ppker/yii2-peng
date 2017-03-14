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
                            <input type="hidden" name="hotel_photo" id="h_hotel_photo" value="">
                        </div>

                    </div>
                    <!--上传照片-->
                    <div id="fileupload">
                        <label for="mark" class="control-label col-sm-2">上传照片</label>
                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                        <div class="row col-sm-10">
                            <div class="col-lg-7">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn green fileinput-button">
                                <i class="fa fa-plus"></i>
                                <span> 添加图片... </span>
                                <input type="file" name="UploadForm[imageFile]"> </span>
                                <!-- The global file processing state -->
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
                        <table role="presentation" class="table table-striped clearfix table-image">
                            <tbody class="files"> </tbody>
                        </table>
                    </div>


                    <!--上传图片结束-->

                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 text-center">
                            <button type="button" class="btn default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn green" id="btn-save">添加</button>
                        </div>
                    </div>
                </form>



                <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
                <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-upload fade">
                                <td>
                                    <span class="preview"></span>
                                </td>
                                <td>
                                    <p class="name">{%=file.name%}</p>
                                    <strong class="error text-danger label label-danger"></strong>
                                </td>
                                <td>
                                    <p class="size">Processing...</p>
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                </td>
                                <td> {% if (!i && !o.options.autoUpload) { %}
                                    <button class="btn blue start" disabled>
                                        <i class="fa fa-upload"></i>
                                        <span>Start</span>
                                    </button> {% } %} {% if (!i) { %}
                                    <button class="btn red cancel">
                                        <i class="fa fa-ban"></i>
                                        <span>Cancel</span>
                                    </button> {% } %}
                                    <button class="btn green b-delete">
                                        <i class="fa fa-delete"></i>
                                        <span>delete</span>
                                    </button>

                                    </td>
                            </tr> {% } %} </script>
                <!-- The template to display files available for download -->
                <script id="template-download" type="text/x-tmpl">{% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-download fade">
                                <td>
                                    <span class="preview"> {% if (file.thumbnailUrl) { %}
                                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                            <img src="{%=file.thumbnailUrl%}">
                                        </a> {% } %} </span>
                                </td>
                                <td>
                                    <p class="name"> {% if (file.url) { %}
                                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                                        <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                                    <div>
                                        <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
                                <td>
                                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                </td>

                                <td> {% if (file.deleteUrl) { %}
                                    <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                        <i class="fa fa-trash-o"></i>
                                        <span>Delete</span>
                                    </button>
                                    <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
                                    <button class="btn yellow cancel btn-sm">
                                        <i class="fa fa-ban"></i>
                                        <span>Cancel</span>
                                    </button> {% } %} </td>
                            </tr> {% } %} </script>


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
