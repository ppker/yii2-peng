<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/19
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding-left: 0;">
    <div class="mt-card-item">
        <div class="mt-card-avatar mt-overlay-1">
           <img class="dish-img" src="<?= Yii::getAlias('@web/images/' . $model->photo);?>" />
        </div>
        <div class="mt-card-content">
            <h3 class="mt-card-name" style="margin-left: 14px;"><?= Html::encode($model->name); ?></h3>
            <div class="hotel-star">
                <span class="star-ranking clearfix">
                    <!-- 5颗星60px长度，算此时星级的长度 -->
                    <span class="star-score" style="width: 69px"></span>
                </span>
                <span class="score-num fl">4.7分</span>
                <span class="total cc-lightred-new fr">月售200单</span>
            </div>

            <div class="mt-card-social">
                <?php
                $like = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-thumbs-o-up']) . ' ' . Html::tag('span', $model->zan) . ' 个赞',
                    'javascript:;',
                    [
                        'data-do' => 'zan',
                        'data-id' => $model->id,
                        'data-type' => 'dish',
                        'class' => 'zan_hate ' . (($model->zan) ? 'active' : '')
                    ]
                );
                $hate = Html::a(
                    Html::tag('i', '', ['class' => 'fa fa-thumbs-o-down']) . ' ' . Html::tag('span', $model->hate) . ' 个踩',
                    'javascript:;',
                    [
                        'data-do' => 'hate',
                        'data-id' => $model->id,
                        'data-type' => 'dish',
                        'class' => 'zan_hate ' . (($model->hate) ? 'active' : '')
                    ]
                );
                ?>
                <ul>
                    <li>
                        <?= $like; ?>
                    </li>
                    <li>
                        <?= $hate; ?>
                    </li>
                </ul>
            </div>
            <div class="buy clearfix">
                <span class="label label-info" style="margin-left: 14px;">¥<?= Html::encode($model->price); ?>/份</span>
                <a class="btn btn-danger btn-sm pull-right buy_car" data-hotel="<?= $hotel_id; ?>" data-dish="<?= $model->id;?>" style="margin-top: -6px;margin-right: 14px;" href="javascript:;">购买</a>
            </div>
        </div>
    </div>
</div>