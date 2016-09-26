<?php

namespace halumein\cashbox;

use Yii;

class Module extends \yii\base\Module
{
    public $adminRoles = ['admin', 'superadmin'];
    public $userRoles = ['@'];
    public $orderModel = 'pistol88\order\models\Order';
    public $userModel = null;
    public $paymentSuccessRedirect = '/cashbox/operation/index';
    public $printRedirect = null;
    public $userForCashbox = '\common\models\User';

    public function init()
    {
        if ($this->userModel === null) {
            $this->userModel = Yii::$app->user->identity;
        } elseif (is_callable($this->userModel)) {
            $userModel = $this->userModel;
            $this->userModel = $userModel();
        }

        parent::init();
    }

}
