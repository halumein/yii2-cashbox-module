<?php
namespace halumein\cashbox;

use yii\base\BootstrapInterface;
use yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if(!$app->has('cashboxOperation')) {
            $app->set('cashboxOperation', ['class' => 'halumein\cashbox\CashboxOperation']);
        }
    }
}
