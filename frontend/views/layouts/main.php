<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/28
 * Project: Cat Visual
 */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\EndAsset;
use frontend\assets\AppAsset;

EndAsset::register($this);

$context = $this->context;
$route = $context->action->getUniqueId();
$js_file = EndAsset::get_js($route, dirname(__DIR__));

// var_dump($js_file);die;
if ($js_file) AppAsset::addScript($this, $js_file);
$this->beginPage();
?>


