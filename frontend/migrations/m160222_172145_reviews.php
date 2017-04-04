<?php

use yii\db\Schema;
use yii\db\Migration;

class m160222_172145_reviews extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tourfirms_reviews}}', [
            'id' => $this->primaryKey()->notNull(),
            'comment' => $this->string(255)->notNull(),
            'user_id' => $this->integer(11),
            'tourfirm_id' => $this->integer(11),
            'date_create' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirms_reviews}}');
    }
}
