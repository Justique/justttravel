<?php

use yii\db\Schema;
use yii\db\Migration;

class m160228_182315_add_column_transports extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%transports}}', 'class', $this->string(100));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%transports}}', 'class');

    }
}
