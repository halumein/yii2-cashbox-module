<?php

use yii\db\Schema;
use yii\db\Migration;

class m160912_121712_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_cashbox_exchange_from_cashbox_id','{{%cashbox_exchange}}','from_cashbox_id','cashbox_cashbox',
'id');
        $this->addForeignKey('fk_cashbox_exchange_to_cashbox_id','{{%cashbox_exchange}}','to_cashbox_id','cashbox_cashbox',
'id');
    }

    public function safeDown()
    {
     $this->dropForeignKey('fk_cashbox_exchange_from_cashbox_id', '{{%cashbox_exchange}}');
     $this->dropForeignKey('fk_cashbox_exchange_to_cashbox_id', '{{%cashbox_exchange}}');
    }
}
