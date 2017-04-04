<?php

use yii\db\Migration;

class m160402_112015_add_column_transport extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%transports}}', 'about', $this->string(100));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%transports}}', 'about');

    }
}
