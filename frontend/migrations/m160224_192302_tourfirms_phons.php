<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_192302_tourfirms_phons extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tourfirms_phons}}', [
            'id' => $this->primaryKey()->notNull(),
            'tourfirm_id' => $this->integer(11)->notNull(),
            'phone1' => $this->string(80),
            'phone2' => $this->string(80),
            'phone3' => $this->string(80),
            'phone4' => $this->string(80),
        ]);
        $this->addForeignKey('tourfirms_phons', '{{%tourfirms_phons}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirms_phons}}');
    }
}
