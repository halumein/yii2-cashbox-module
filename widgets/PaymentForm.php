<?php
namespace halumein\cashbox\widgets;

use yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Operation;

class PaymentForm extends \yii\base\Widget
{
    public $actionUrl = null;
    public $order = null;
    public $cost = null;
    public $useAjax = null;

    public function init()
    {
        if ($this->actionUrl === null) {
            $this->actionUrl = '/cashbox/operation/payment-confirm';
        }

        parent::init();

        \halumein\cashbox\assets\PaymentFormAsset::register($this->getView());

        return true;
    }

    public function run()
    {
        if ($this->order === null) {
            return false;
        }

        $userModel = Yii::$app->getModule('cashbox')->userModel;

        $operationModel = new Operation();
        $cashboxes = Cashbox::getAvailable();

        $operationModel->cashbox_id = $userModel->defaultCashbox;

        return $this->render('paymentForm', [
            'model' => $operationModel,
            'order' => $this->order,
            'cashboxes' => $cashboxes,
            'useAjax' => $this->useAjax,
        ]);
    }
}
