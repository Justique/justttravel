<?php

use yii\db\Migration;

class m160404_141528_add_column_appfortours extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%application_for_tours}}', 'days', $this->Integer(2));
        $this->addColumn('{{%application_for_tours}}', 'nights', $this->Integer(2));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%application_for_tours}}', 'days');
        $this->dropColumn('{{%application_for_tours}}', 'nights');
    }
}
