<?php
namespace halumein\cashbox\events;

use yii\base\Event;

class PaymentEvent extends Event
{
    public $text;
}
