<?php

use yii\db\Schema;
use yii\db\Migration;

class m160307_111547_visa_order extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%visa_order}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->string(100)->notNull(),
            'visa_id' => $this->integer(11)->notNull(),
            'name' => $this->string(100),
            'email' => $this->string(100),
            'created' => $this->integer(11),
        ]);
        $this->addForeignKey('visa_order', '{{%visa_order}}', 'visa_id', '{{%visa}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%visa_order}}');
    }
}
