<?php

use yii\db\Schema;
use yii\db\Migration;

class m160926_064511_cashbox_user_to_cashbox extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%cashbox_user_to_cashbox}}',
            [
                'id'=> Schema::TYPE_PK."",
                'user_id'=> Schema::TYPE_INTEGER."(11) NOT NULL",
                'cashbox_id'=> Schema::TYPE_INTEGER."(11) NOT NULL",
                ],
            $tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%cashbox_user_to_cashbox}}');
    }
}
