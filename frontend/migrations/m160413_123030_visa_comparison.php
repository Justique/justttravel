<?php

use yii\db\Migration;

class m160413_123030_visa_comparison extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%visa_comparison}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'visa_id' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%visa_comparison}}');
    }
}
