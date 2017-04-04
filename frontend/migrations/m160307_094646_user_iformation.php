<?php

use yii\db\Schema;
use yii\db\Migration;

class m160307_094646_user_iformation extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user_iformation}}', [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(100)->notNull(),
            'question' => $this->string(255)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'email' => $this->string(100),
            'created' => $this->integer(11),

        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_iformation}}');
    }
}
