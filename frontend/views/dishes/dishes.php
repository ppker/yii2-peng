<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/19
 */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\EndAsset;

EndAsset::addScript($this, Yii::getAlias("@web/static/js/views/dishes/list.js"));
?>

<div class="container" style="padding: 20px 0;">
    <div class="page-content-inner">
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="portlet mt-element-ribbon light portlet-fit bordered">
                    <div class="ribbon ribbon-left ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                        <div class="ribbon-sub ribbon-clip ribbon-left"></div><?= $hotel->name; ?>
                    </div>
                    <div class="portlet-title">
                    </div>
                    <div class="portlet-body">
                        <div class="details clearfix">
                            <div class="img-avatar pull-left">
                                <img alt="饭店图片" src="<?= Yii::getAlias('@web/images/' . $hotel->photo);?>" class="img-circle img-avatar">
                            </div>
                            <div class="img-info pull-left">
                                <div class="one-line">
                                    <h2 style="margin-top: 7px;"><?= $hotel->name; ?></h2>
                                </div>
                                <div class="one-line-info">
                                    <div class="hotel-star hotel-star-detail">
                                        <span class="star-ranking">
                                            <span class="star-score" style="width: 69px"></span>
                                        </span>
                                        <span class="score-num" style="padding-left: 6px;">4.7分</span>
                                    </div>
                                    <div class="hotel-work">
                                        <span>营业时间：</span>
                                        <span>10:33--02:30</span>
                                    </div>
                                    <div class="hotel-work">
                                        <span>商家地址：</span>
                                        <span><?= Html::encode($hotel->address); ?></span>
                                    </div>
                                    <div class="hotel-work">
                                        <span>商家电话：</span>
                                        <span><?= Html::encode($hotel->phone); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">菜单列表</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">菜单
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> Option 1</a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;">Option 2</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Option 3</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Option 4</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body clearfix">
                        <ul class="nav nav-pills">
                            <li class="active" style="width: 10%; text-align: center;">
                                <a href="#tab_2_1" data-toggle="tab">菜单</a>
                            </li>
                            <li style="width: 10%; text-align: center;">
                                <a href="#tab_2_2" data-toggle="tab">评价</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab_2_1">
                                <div class="col-lg-9 col-md-9 portlet-body" style="padding-left: 0;">

                                    <?php if (!empty($dishes)) {
                                        foreach ($dishes as $key => $value) {
                                            echo $this->render('_item', ['model' => $value, 'hotel_id' => $hotel->id]);
                                        }
                                    } else {
                                        echo \Yii::t('app', '此处没有数据');
                                    } ?>


                                </div>
                                <div class="col-lg-3 col-md-3 portlet-body" style="padding-left: 0;padding-right: 0;">
                                    <div class="portlet mt-element-ribbon light portlet-fit bordered">
                                        <div class="ribbon ribbon-left ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
                                            <div class="ribbon-sub ribbon-clip ribbon-left" id="gonggao"></div>公告</div>
                                        <div class="portlet-title"></div>
                                        <div class="portlet-body">
                                            这里是公告啊。这里是公告啊。这里是公告啊。这里是公告啊。
                                            这里是公告啊。这里是公告啊。这里是公告啊。这里是公告啊。
                                            这里是公告啊。这里是公告啊。这里是公告啊。这里是公告啊。
                                        </div>
                                    </div>

                                    <div class="shopping-cart clearfix" style="bottom: 0;">
                                        <div class="mt-element-ribbon bg-grey-steel" style="margin-bottom: 0;">
                                            <div class="ribbon ribbon-left ribbon-vertical-left ribbon-shadow ribbon-border-dash-vert ribbon-color-primary uppercase">
                                                <div class="ribbon-sub ribbon-bookmark"></div>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="ribbon-content">
                                                <table class="table table-condensed table-bordered table-shopping-car" style="border: 1px solid #345c84; text-align: center;">
                                                    <thead>
                                                        <tr class="table-head">
                                                            <th>菜品</th>
                                                            <th>份数</th>
                                                            <th>价格</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="shopping_car_tbody">

                                                        <tr class="success">
                                                            <td>合计</td>
                                                            <td><span id="total_num_f">0</span>份</td>
                                                            <td>¥<span id="total_price_f">0</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <button class="btn btn-danger btn-sm" id="qxd">去下单</button>
                                                <button class="btn btn-info btn-sm" id="clear">清空</button>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab_2_2">
                                萨弗蒂萨达发生大
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>