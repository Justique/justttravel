<?php

use yii\db\Schema;
use yii\db\Migration;

class m160227_175955_add_column_feedback extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%customer_feedback}}', 'tourfirm_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%customer_feedback}}', 'tourfirm_id');

    }
}
