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

    public function testTrigger()
    {
        $event = new \halumein\cashbox\events\TestEvent;
        $event->text = 13;
        $this->trigger(self::EVENT_TEST, $event);
    }

}
