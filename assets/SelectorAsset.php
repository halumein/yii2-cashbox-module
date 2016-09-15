<?php
namespace halumein\cashbox\assets;

use yii\web\AssetBundle;

class SelectorAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/selector.js',
    ];

    public $css = [
        'css/selector.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }
}
