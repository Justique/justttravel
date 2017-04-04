<?php

use yii\db\Schema;
use yii\db\Migration;

class m160311_151713_recolumn_tours extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%tours}}', 'count_kids');
        $this->addColumn('{{%tours}}', 'count_kids', $this->integer()->defaultValue(null));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'count_kids');
    }
}
