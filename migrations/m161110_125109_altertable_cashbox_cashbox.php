<?php

use yii\db\Schema;
use yii\db\Migration;

class m161110_125109_altertable_cashbox_cashbox extends Migration
{
    public function up()
    {
    	$this->addColumn('{{%cashbox_cashbox}}','organization_id', $this->integer(11)->null()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('{{%cashbox_cashbox}}', 'organization_id');
    }
}
