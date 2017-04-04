<?php

use yii\db\Schema;
use yii\db\Migration;

class m160225_162401_tourfirm_work_time extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tourfirm_work_time}}', [
            'id' => $this->primaryKey()->notNull(),
            'tourfirm_id' => $this->integer(11)->notNull(),
            'monday' => $this->string(20),
            'tuesday' => $this->string(20),
            'wednesday' => $this->string(20),
            'thursday' => $this->string(20),
            'friday' => $this->string(20),
            'saturday' => $this->string(20),
            'sunday' => $this->string(20),
        ]);
        $this->addForeignKey('tourfirm_work_time', '{{%tourfirm_work_time}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirm_work_time}}');
    }
}
