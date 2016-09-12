<?php

namespace halumein\cashbox;

class Module extends \yii\base\Module
{
    public $adminRoles = ['admin', 'superadmin'];
    public $userRoles = ['@'];
    public $orderModel = 'pistol88\order\models\Order';


    public function init()
    {
        parent::init();
    }
}
