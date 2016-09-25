<?php

use yii\db\Schema;
use yii\db\Migration;

class m160922_070212_Mass extends Migration
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
           'balance'=> $this->decimal(11, 2)->notNull(),
           'sum'=> $this->decimal(11, 2)->notNull(),
           'cashbox_id'=> $this->integer(11)->notNull(),
           'model'=> $this->string(255)->null()->defaultValue(null),
           'item_id'=> $this->integer(11)->null()->defaultValue(null),
           'date'=> $this->dateTime()->notNull(),
           'client_id'=> $this->integer(11)->null()->defaultValue(null),
           'staffer_id'=> $this->integer(11)->notNull(),
           'comment'=> $this->text()->null()->defaultValue(null),
           'status'=> $this->string()->notNull()->defaultValue('created'),
        ], $tableOptions);
        $this->createIndex('cashbox_id','{{%cashbox_operation}}','cashbox_id',true);
        $this->addForeignKey('fk_cashbox_operation_cashbox_id','{{%cashbox_operation}}','cashbox_id','cashbox_cashbox','id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_cashbox_operation_cashbox_id', '{{%cashbox_operation}}');
        $this->dropTable('{{%cashbox_operation}}');
    }
}
