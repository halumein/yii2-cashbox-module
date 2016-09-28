<?php
namespace halumein\cashbox;

use yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if(!$app->has('cashboxOperation')) {
            $app->set('cashboxOperation', ['class' => 'halumein\cashbox\CashboxOperation']);
        }
    }
}
