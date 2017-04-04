<?php

use yii\db\Schema;
use yii\db\Migration;

class m160507_143521_visa_reset extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%visa}}', 'tourfirm_id');
        $this->addColumn('{{%visa}}', 'tourfirm_id', $this->integer(11));
        $this->addForeignKey('visa_tourfirms', '{{%visa}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%visa}}', 'tourfirm_id');
    }
}
