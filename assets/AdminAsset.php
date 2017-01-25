<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css;
    public $js;
    public function init()
    {
        $this->css = [
            'css/style.css',
            'css/global.css',
            'css/admin/admin.css',
        ];
        $this->js = [
            '/js/global.js?'.time(),
        ];
        parent::init(); // TODO: Change the autogenerated stub

    }
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}