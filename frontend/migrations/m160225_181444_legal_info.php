<?php

use yii\db\Schema;
use yii\db\Migration;

class m160225_181444_legal_info extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tourfirms}}', 'legal_info', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tourfirms}}', 'legal_info');

    }
}
