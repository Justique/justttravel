<?php

use yii\db\Schema;
use yii\db\Migration;

class m160301_170032_add_column_article extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%article}}', 'tourfirm_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%article}}', 'tourfirm_id');
    }
}
