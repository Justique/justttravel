<?php

use yii\db\Schema;
use yii\db\Migration;

class m160221_133139_add_column_visa extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%visa}}', 'slug', $this->string(200));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%visa}}', 'slug');
    }
}
