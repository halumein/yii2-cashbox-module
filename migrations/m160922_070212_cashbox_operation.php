<?php

use yii\db\Schema;
use yii\db\Migration;

class m160922_070212_cashbox_operation extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
        $this->createTable('{{%cashbox_operation}}',[
           'id'=> $this->primaryKey(11),
           'type'=> $this->string()->notNull(),
           'balance'=> $this->decimal(19, 2)->notNull(),
           'sum'=> $this->decimal(19, 2)->notNull(),
           'cashbox_id'=> $this->integer(11)->notNull(),
           'model'=> $this->string(255)->null()->defaultValue(null),
           'item_id'=> $this->integer(11)->null()->defaultValue(null),
           'date'=> $this->dateTime()->notNull(),
           'client_id'=> $this->integer(11)->null()->defaultValue(null),
           'staffer_id'=> $this->integer(11)->notNull(),
           'comment'=> $this->text()->null()->defaultValue(null),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cashbox_operation}}');
    }
}
