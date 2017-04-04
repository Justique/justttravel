<?php

use yii\db\Migration;

class m160413_123019_tours_comparison extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tours_comparison}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'tour_id' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tours_comparison}}');
    }
}
