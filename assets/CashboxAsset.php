<?php
namespace halumein\cashbox\assets;

use yii\web\AssetBundle;

class CashboxAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/test.js'
    ];

    public $css = [
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }
}
