<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/1/18
 */

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\common\PublicModel;

class Menu extends \common\models\Menu {

    public function rules() {

        return ArrayHelper::merge(parent::rule(), [
            [['title', 'url'], 'required']
        ]);
    }

    /**
     * 检测权限
     * @param $rule
     * @return bool
     */
    public static function checkRule($rule, $user = null) {

        if (!empty($user)) { // 针对api的权限验证
            // if (Yii::$app->params['adminId'] == $user->id || "" == $rule) return true;
            $user_model = Yii::$app->user;
            $user_model->setIdentity($user);
            if (!$user_model->can($rule)) return false;
            return true;
        }

        if (Yii::$app->params['adminId'] == Yii::$app->user->id || "" == $rule) {
            return true;
        }
        if (!\Yii::$app->user->can($rule)) {
            return false;
        }
        return true;
    }

    public static function getMenus($rule = 'index/index') {

        $menus = [];
        // 获取顶层主菜单
        $menus['main'] = static::find()->where(['pid' => 0, 'hide' => 0])->orderBy('sort ASC')->asArray()->all();

        $menus['child'] = []; // 左栏的菜单

        $nav = static::getBreadcrumbs($rule);
        // 获取当前active主菜单对应的左菜单
        foreach($menus['main'] as $key => $item) {
            if (!is_array($item) || empty($item['title']) || empty($item['url'])) {
                // throw error
            }
            // 过滤权限
            if (!static::checkRule($item['url'])) {
                unset($menus['main'][$key]);
                continue;
            }
            // 获取当前acive菜单的子菜单项
            if ($nav[0]['id'] == $item['id']) {
                // 高亮
                $menus['main'][$key]['class'] = 'active';
                // 获取二级菜单
                $second_menu = static::find()->where(['pid' => $item['id'], 'hide' => 0])->orderBy('sort ASC')->asArray()->all();
                // 过滤二级菜单的权限
                if ($second_menu && is_array($second_menu)) {
                    foreach($second_menu as $skey => $check_menu) {
                        if (!static::checkRule($check_menu['url'])) {
                            unset($second_menu[$skey]);
                            continue;
                        }
                    }
                }
                // 生成child树
                $groups = static::find()->select(['group'])->where(['pid' => $item['id'], 'hide' => 0])
                    ->groupBy(['group'])->orderBy('sort ASC')->asArray()->column();
                foreach($groups as $k => $g) {
                    $menuList = static::find()
                        ->where(['pid' => $item['id'], 'hide' => 0, 'group' => $g, 'url' => $second_menu])
                        ->orderBy('sort ASC')->asArray()->all();
                    list($g_name, $g_icon) = strpos($g, '|') ? explode('|', $g) : [$g, 'icon-cogs'];
                    $menus['child'][$k]['name'] = $g_name;
                    $menus['child'][$k]['icon'] = $g_icon;
                    $menus['child'][$k]['_child'] = PublicModel::list_to_tree($menuList, 'id', 'pid', 'operator', $item['id']);
                }
            }
        }
        return $menus;
    }

    public static function getBreadcrumbs($rule = 'index/index') {

        $rule = strtolower($rule);
        $current = static::find()->select('id')->where(['and', 'pid != 0', ['like', 'url', $rule]])->asArray()->one();
        $nav = static::getParentMenus($current['id']);
        return $nav;
    }

    public static function getParentMenus($id) {

        $path = [];
        $nav = static::find()->select(['id', 'pid', 'title'])->where(['id' => $id])->asArray()->one();
        $path[] = $nav;
        if ($nav['pid'] > 0) {
            $path = array_merge(static::getParentMenus($nav['pid']), $path);
        }
        return $path;
    }


}