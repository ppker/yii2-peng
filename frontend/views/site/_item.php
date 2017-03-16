<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/16
 * Project: Cat Visual
 */

use Yii;
use yii\helpers\Html;

?>
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="mt-card-item">
        <div class="mt-card-avatar mt-overlay-1">
            <img src="<?= Yii::getAlias('@web/static/images/team2.jpg');?>" />
            <div class="mt-overlay">
                <ul class="mt-info">
                    <li>
                        <a class="btn default btn-outline" href="javascript:;">
                            <i class="icon-magnifier"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn default btn-outline" href="javascript:;">
                            <i class="icon-link"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mt-card-content">
            <h3 class="mt-card-name">Mark Anthony</h3>
            <p class="mt-card-desc font-grey-mint">Managing Director</p>
            <div class="mt-card-social">
                <ul>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-social-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-social-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="icon-social-dribbble"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
