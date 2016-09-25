<?php

use yii\db\Schema;
use yii\db\Migration;

class m160912_121711_cashbox_exchange extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%cashbox_exchange}}',
            [
                'id'=> $this->primaryKey(11),
                'from_cashbox_id'=> $this->integer(11)->notNull(),
                'from_sum'=> $this->decimal(10, 2)->notNull()->defaultValue('0.00'),
                'to_cashbox_id'=> $this->integer(11)->notNull(),
                'to_sum'=> $this->decimal(10, 2)->notNull()->defaultValue('0.00'),
                'date'=> $this->datetime()->notNull(),
                'rate'=> $this->decimal(10, 2)->notNull()->defaultValue('1.00'),
                'staffer_id'=> $this->integer(11)->notNull(),
                'comment'=> $this->string(500)->notNull(),
                'deleted'=> $this->datetime()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('from_cashbox_id','{{%cashbox_exchange}}','from_cashbox_id',true);
        $this->createIndex('to_cashbox_id','{{%cashbox_exchange}}','to_cashbox_id',true);
    }

    public function safeDown()
    {
        $this->dropIndex('from_cashbox_id', '{{%cashbox_exchange}}');
        $this->dropIndex('to_cashbox_id', '{{%cashbox_exchange}}');
        $this->dropTable('{{%cashbox_exchange}}');
    }
}
