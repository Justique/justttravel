<?php

use yii\db\Migration;

class m160321_143302_interest extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%interests}}', [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(255),
            'count' => $this->integer(11),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%interests}}');
    }
}
