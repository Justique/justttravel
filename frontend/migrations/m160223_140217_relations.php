<?php

use yii\db\Schema;
use yii\db\Migration;

class m160223_140217_relations extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tourfirms_users}}', [
            'id' => $this->primaryKey()->notNull(),
            'tourfirm_id' => $this->integer(11),
            'user_id' => $this->integer(11),

        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirms_users}}');
    }
}
