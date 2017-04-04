<?php

use yii\db\Schema;
use yii\db\Migration;

class m160307_120410_tours_order extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tours_order}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'tour_id' => $this->integer(11)->notNull(),
            'name' => $this->string(100),
            'date' => $this->string(50),
            'email' => $this->string(100),
            'created' => $this->integer(11),
        ]);
        $this->addForeignKey('tours_order', '{{%tours_order}}', 'tour_id', '{{%tours}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%tours_order}}');
    }
}
