<?php

use yii\db\Schema;
use yii\db\Migration;

class m160225_115153_add_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tourfirms}}', 'touroperator_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tourfirms}}', 'hot');

    }
}
