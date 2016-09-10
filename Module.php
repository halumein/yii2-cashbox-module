<?php

namespace halumein\cashbox;

class Module extends \yii\base\Module
{
    public $adminRoles = ['admin', 'superadmin'];
    public $userRoles = ['@'];
    
    public function init()
    {
        parent::init();

    }
}
