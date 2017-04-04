<?php

use yii\db\Migration;

class m160322_141427_add_column_tours extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tours}}', 'country_from_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'country_from_id');
    }
}
