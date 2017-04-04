<?php

use yii\db\Migration;

class m160328_132842_add_column_useraplication extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user_application}}', 'transport_type', $this->smallInteger(1));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user_application}}', 'transport_type');
    }
}
