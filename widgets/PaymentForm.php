<?php
namespace halumein\cashbox\widgets;

use yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox;

class PaymentForm extends \yii\base\Widget
{
    public $actionUrl = null;

    public function init()
    {

        if ($this->actionUrl === null) {
            $this->actionUrl = '/cashbox/tools/setUserCashbox';
        }

        parent::init();

        \halumein\cashbox\assets\PaymentFormAsset::register($this->getView());

        return true;
    }

    public function run()
    {

        return $this->render('paymentForm', [

        ]);



    }
}
