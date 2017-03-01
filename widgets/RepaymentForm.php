<?php
namespace halumein\cashbox\widgets;

use yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use halumein\cashbox\models\Cashbox;
use halumein\cashbox\models\Operation;

class RepaymentForm extends \yii\base\Widget
{
    public $actionUrl = null;
    public $order = null;
    public $cost = null;
    public $useAjax = false;
    public $lessSum = false;
    public $formCssClass = 'repayment-modal-form';


    public function init()
    {
        parent::init();

        if ($this->actionUrl === null) {
            $this->actionUrl = '/cashbox/operation/payment-confirm';
        }

        \halumein\cashbox\assets\RepaymentFormAsset::register($this->getView());

        return true;
    }

    public function run()
    {
        if ($this->order === null) {
            return false;
        }

        // $userModel = Yii::$app->getModule('cashbox')->userModel;
        $order = $this->order;

        $lastOperations = Operation::find()->where([
                        'model' => $order::className(),
                        'item_id' => $order->id
                    ])->all();

        $operationModel = new Operation();
        $cashboxes = Cashbox::getAvailable();

        $operationModel->cashbox_id = \Yii::$app->user->identity->defaultCashbox;

        if ($paymentTypeToCashbox = Yii::$app->getModule('cashbox')->paymentTypeToCashbox) {
            if (isset($paymentTypeToCashbox[$this->order->payment_type_id])) {
                $operationModel->cashbox_id = $paymentTypeToCashbox[$this->order->payment_type_id];
            }
        }

        return $this->render('repaymentForm', [
            'model' => $operationModel,
            'lastPayments' => $lastOperations,
            'totalPayedSum' => \Yii::$app->cashbox->getPaymentsSumByOrder($order->id),
            'order' => $order,
            'cashboxes' => $cashboxes,
            'useAjax' => $this->useAjax,
            'formCssClass' => $this->formCssClass
        ]);
    }
}
