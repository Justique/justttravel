<?php

use yii\db\Migration;

class m160402_110217_add_column_userapp extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user_application}}', 'days', $this->Integer(2));
        $this->addColumn('{{%user_application}}', 'nights', $this->Integer(2));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user_application}}', 'days');
        $this->dropColumn('{{%user_application}}', 'nights');
    }
}
