<?php

use yii\db\Schema;
use yii\db\Migration;

class m160229_191707_add_columns_visa extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%visa}}', 'manager_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%visa}}', 'manager_id');
    }
}
