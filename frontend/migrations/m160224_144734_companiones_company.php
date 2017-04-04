<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_144734_companiones_company extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%companiones_company}}', [
            'id' => $this->primaryKey()->notNull(),
            'man' => $this->string(50),
            'woman' => $this->string(50),
            'companion_id' => $this->integer(11),
        ]);
        $this->addForeignKey('companiones_company', '{{%companiones_company}}', 'companion_id', '{{%companiones}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%companiones_company}}');
    }
}
