<?php

use yii\db\Schema;
use yii\db\Migration;

class m160308_131523_reviews_votes extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%reviews_votes}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'reviews_id' => $this->integer(11)->notNull(),
            'vote' => $this->smallInteger(1)->notNull(),
        ]);
        $this->addForeignKey('reviews_votes', '{{%reviews_votes}}', 'reviews_id', '{{%tourfirms_reviews}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%reviews_votes}}');
    }
}
