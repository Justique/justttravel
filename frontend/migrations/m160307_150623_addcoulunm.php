<?php

use yii\db\Schema;
use yii\db\Migration;

class m160307_150623_addcoulunm extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%customer_feedback}}', 'user_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%customer_feedback}}', 'user_id');

    }
}
