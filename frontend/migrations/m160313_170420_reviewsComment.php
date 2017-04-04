<?php

use yii\db\Schema;
use yii\db\Migration;

class m160313_170420_reviewsComment extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%reviewsComment}}', [
            'id' => $this->primaryKey()->notNull(),
            'reviews_id' => $this->integer(11)->notNull(),
            'comment' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'date_create' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('reviewsComment', '{{%reviewsComment}}', 'reviews_id', '{{%tourfirms_reviews}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%reviewsComment}}');
    }
}
