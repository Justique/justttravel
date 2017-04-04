<?php

use yii\db\Schema;
use yii\db\Migration;

class m160221_150112_add_column_tourfirms extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tourfirms}}', 'slug', $this->string(200));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tourfirms }}', 'slug');
    }
}
