<?php

use yii\db\Schema;
use yii\db\Migration;

class m160306_173416_add_column_reviews extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tourfirms_reviews}}', 'status', $this->smallInteger(1));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tourfirms_reviews}}', 'status');
    }
}
