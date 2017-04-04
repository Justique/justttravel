<?php

use yii\db\Schema;
use yii\db\Migration;

class m160226_151703_managers_phone extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%managers_phone}}', [
            'id' => $this->primaryKey()->notNull(),
            'manager_id' => $this->integer(11)->notNull(),
            'default' => $this->string(80),
            'life' => $this->string(80),
            'mts' => $this->string(80),
            'viber' => $this->string(80),
            'skype' => $this->string(80),
            'icq' => $this->string(80),
        ]);
        $this->addForeignKey('managers_phone', '{{%managers_phone}}', 'manager_id', '{{%user}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%managers_phone}}');
    }
}
