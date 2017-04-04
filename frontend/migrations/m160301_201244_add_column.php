<?php

use yii\db\Schema;
use yii\db\Migration;

class m160301_201244_add_column extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%companiones_gender}}', [
            'id' => $this->primaryKey()->notNull(),
            'class_gender' => $this->string(100),
            'gender' => $this->string(100),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%companiones_gender}}');
    }
}
