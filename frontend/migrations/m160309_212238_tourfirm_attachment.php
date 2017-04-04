<?php

use yii\db\Schema;
use yii\db\Migration;

class m160309_212238_tourfirm_attachment extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tourfirm_attachment}}', [
            'id' => $this->primaryKey()->notNull(),
            'tourfirm_id' => $this->integer(11)->notNull(),
            'path' => $this->string(255),
            'base_url' => $this->string(255),
            'type' => $this->string(255),
            'name' => $this->string(255),
            'size' => $this->integer(11),
            'created_at' => $this->integer(11),
            'order' => $this->integer(11),
        ]);
        $this->addForeignKey('tourfirm_attachment', '{{%tourfirm_attachment}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirm_attachment}}');
    }
}
