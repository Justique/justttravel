<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_183959_companiones_interests extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%companiones_interests}}', [
            'id' => $this->primaryKey()->notNull(),
            'interests' => $this->string(50),
            'companion_id' => $this->integer(11),
        ]);
        $this->addForeignKey('companiones_interests', '{{%companiones_interests}}', 'companion_id', '{{%companiones}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%companiones_interests}}');
    }
}
