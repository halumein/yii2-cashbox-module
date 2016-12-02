<?php

use yii\db\Schema;
use yii\db\Migration;

class m161202_125123_altertable_cashbox_cashbox extends Migration
{
    public function up()
    {
    	$this->addColumn('{{%cashbox_operation}}','cancel', $this->boolean()->null()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('{{%cashbox_operation}}', 'cancel');
    }
}
