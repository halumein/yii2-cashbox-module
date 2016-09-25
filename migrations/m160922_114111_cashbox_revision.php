<?php

use yii\db\Schema;
use yii\db\Migration;

class m160922_114111_cashbox_revision extends Migration
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
            '{{%cashbox_revision}}',
            [
                'id'=> $this->primaryKey(11),
                'cashbox_id'=> $this->integer(11)->notNull(),
                'balance_fact'=> $this->decimal(2, 10)->notNull()->defaultValue('0.00'),
                'balance_expect'=> $this->decimal(2, 10)->notNull()->defaultValue('0.00'),
                'date'=> $this->datetime()->notNull(),
                'user_id'=> $this->integer(11)->notNull(),
                'comment'=> $this->text()->null()->defaultValue(null),
            ],$tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%cashbox_revision}}');
    }
}
