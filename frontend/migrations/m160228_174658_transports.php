<?php

use yii\db\Schema;
use yii\db\Migration;

class m160228_174658_transports extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%transports}}', [
            'id' => $this->primaryKey()->notNull(),
            'type' => $this->string(100)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%transports}}');
    }
}
