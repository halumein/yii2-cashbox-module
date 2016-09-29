<?php

namespace halumein\cashbox;

use Yii;

class Module extends \yii\base\Module
{
    public $adminRoles = ['superadmin', 'admin'];
    public $userRoles = ['@'];
    public $orderModel = 'pistol88\order\models\Order';
    public $userModel = null;
    public $cashiersList = null;
    public $paymentSuccessRedirect = '/cashbox/operation/index';
    public $printRedirect = null;

    public function init()
    {
        if ($this->userModel === null) {
            $this->userModel = Yii::$app->user->identity;
        } elseif (is_callable($this->userModel)) {
            $userModel = $this->userModel;
            $this->userModel = $userModel();
        }

        if ($this->cashiersList === null) {
            $userModel = $this->userModel;
            $this->cashiersList = $userModel::find()->all();
        } elseif (is_callable($this->cashiersList)) {
            $cashiersList = $this->cashiersList;
            $this->cashiersList = $cashiersList();
        }

        parent::init();
    }

}
