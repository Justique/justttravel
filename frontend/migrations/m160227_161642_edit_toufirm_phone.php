<?php

use yii\db\Schema;
use yii\db\Migration;

class m160227_161642_edit_toufirm_phone extends Migration
{
    public function safeUp()
    {
        $this->dropTable('{{%tourfirms_phons}}');
        $this->createTable('{{%tourfirms_phons}}', [
            'id' => $this->primaryKey()->notNull(),
            'tourfirm_id' => $this->integer(11)->notNull(),
            'default' => $this->string(80),
            'mts' => $this->string(80),
            'life' => $this->string(80),
            'viber' => $this->string(80),
            'skype' => $this->string(80),
            'icq' => $this->string(80),
        ]);
        $this->addForeignKey('tourfirms_phons', '{{%tourfirms_phons}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirms_phons}}');
    }
}
