<?php
namespace halumein\cashbox\assets;

use yii\web\AssetBundle;

class PaymentFormAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        'js/paymentForm.js',
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
