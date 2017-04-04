<?php

use yii\db\Migration;

class m160411_083819_tour_attachment extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tour_attachment}}', [
            'id' => $this->primaryKey()->notNull(),
            'tour_id' => $this->integer(11)->notNull(),
            'path' => $this->string(255)->notNull(),
            'base_url' => $this->string(255)->notNull(),
            'type' => $this->string(255)->notNull(),
            'size' => $this->integer(11)->notNull(),
            'name' => $this->string(255)->notNull(),
            'create_at' => $this->integer(11),
            'order' => $this->integer(11),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tour_attachment}}');
    }
}
