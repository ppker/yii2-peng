<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/4/18
 * Project: Cat Visual
 */

use \yii\helpers\Html;
use \yii\helpers\Url;
use frontend\assets\EndAsset;
use frontend\assets\TableAsset;

TableAsset::register($this);
EndAsset::addScript($this, Yii::getAlias("@web/static/js/views/order/log.js"));

$this->title = '今日点餐记录';
$this->params['title_sub'] = '查询今日的点餐记录';
?>
<div class="container" style="padding: 50px 0;">
    <div class="page-content-inner">
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-cogs"></i>点餐记录</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                            <a href="javascript:;" class="reload"> </a>
                            <a href="javascript:;" class="remove"> </a>
                        </div>
                    </div>
                    <div class="portlet-body flip-scroll">
                        <table class="table table-bordered table-striped table-condensed flip-content table-hover" id="table" style="white-space: nowrap;text-align: center;">

                        </table>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>
    </div>
</div>