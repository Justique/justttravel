<?php

use yii\db\Schema;
use yii\db\Migration;

class m160222_150146_add_column_tours extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tours}}', 'tourfirm_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours }}', 'tourfirm_id');
    }

}
