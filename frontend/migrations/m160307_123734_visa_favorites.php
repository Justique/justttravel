<?php

use yii\db\Schema;
use yii\db\Migration;

class m160307_123734_visa_favorites extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%visa_favorites}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'visa_id' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%visa_favorites}}');
    }
}
