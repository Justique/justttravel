<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_135449_add_column_tours extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tours}}', 'hot', $this->smallInteger(1));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'hot');
    }
}
