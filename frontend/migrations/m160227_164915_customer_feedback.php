<?php

use yii\db\Schema;
use yii\db\Migration;

class m160227_164915_customer_feedback extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%customer_feedback}}', [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(50),
            'email' => $this->string(100),
            'phone' => $this->string(50),
            'question' => $this->string(255),
            'date_create' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%customer_feedback}}');
    }
}
