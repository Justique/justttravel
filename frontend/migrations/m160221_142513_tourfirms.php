<?php

use yii\db\Schema;
use yii\db\Migration;

class m160221_142513_tourfirms extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tourfirms}}', [
            'id' => $this->primaryKey()->notNull(),
            'rating' => $this->integer(11),
            'description' => $this->text(),
            'address' => $this->string(200),
            'name' => $this->string(200),
            'phone' => $this->string(200),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirms}}');
    }
}
