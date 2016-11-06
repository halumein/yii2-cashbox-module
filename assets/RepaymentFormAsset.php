<?php
namespace halumein\cashbox\assets;

use yii\web\AssetBundle;

class RepaymentFormAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/repaymentForm.js',
    ];

    public $css = [
        'css/paymentForm.css',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/../web';
        parent::init();
    }
}
