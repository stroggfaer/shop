<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/global.css',
        'css/mob_style.css',
        'scripts/swipebox/swipebox.css',
        'scripts/owl/owl.theme.css',
        'scripts/owl/owl.carousel.css',
    ];
    public $js = [
        'js/script.js',
        'scripts/jquery.easing.js',
        'scripts/swipebox/jquery.swipebox.js',
        'scripts/owl/owl.carousel.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
