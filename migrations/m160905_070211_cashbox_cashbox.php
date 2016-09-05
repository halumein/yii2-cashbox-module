<?php

use yii\db\Schema;
use yii\db\Migration;

class m160905_070211_cashbox_cashbox extends Migration
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
