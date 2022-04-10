<?php

namespace matejch\yii2sidebar;

use yii\web\AssetBundle;

class SidebarAsset extends AssetBundle
{
    public $js = [
        'js/sidebar.min.js'
    ];

    public $css = [
        'css/sidebar.min.css'
    ];


    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}