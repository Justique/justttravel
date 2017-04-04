<?php

use yii\db\Schema;
use yii\db\Migration;

class m160301_113724_add_column_tours extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%tours}}', 'price');
        $this->addColumn('{{%tours}}', 'price', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'price');
    }
}
