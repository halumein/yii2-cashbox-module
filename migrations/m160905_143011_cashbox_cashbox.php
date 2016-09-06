<?php

use yii\db\Schema;
use yii\db\Migration;

class m160905_143011_cashbox_cashbox extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%cashbox_cashbox}}',
            [
                'id'=> Schema::TYPE_PK."",
                'name'=> Schema::TYPE_STRING."(255) NOT NULL",
                'currency'=> Schema::TYPE_STRING."(100)",
                'balance'=> Schema::TYPE_DECIMAL."(10,2) NOT NULL DEFAULT '0.00'",
                'deleted'=> Schema::TYPE_DATETIME."",
                ],
            $tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%cashbox_cashbox}}');
    }
}
