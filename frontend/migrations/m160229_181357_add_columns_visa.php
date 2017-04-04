<?php

use yii\db\Schema;
use yii\db\Migration;

class m160229_181357_add_columns_visa extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%visa}}', 'name', $this->string(50));
        $this->addColumn('{{%visa}}', 'type', $this->string(50));
        $this->addColumn('{{%visa}}', 'type_time', $this->string(50));
        $this->addColumn('{{%visa}}', 'tourfirm_id', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%visa}}', 'type');
        $this->dropColumn('{{%visa}}', 'name');
        $this->dropColumn('{{%visa}}', 'type_time');
        $this->dropColumn('{{%visa}}', 'type_time');
        $this->dropColumn('{{%visa}}', 'tourfirm_id');
    }
}
