<?php

use yii\db\Schema;
use yii\db\Migration;

class m160306_193531_tours_favorits extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tours_favorits}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'tour_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('tours_favorits', '{{%tours_favorits}}', 'tour_id', '{{%tours}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%tours_favorits}}');
    }
}
