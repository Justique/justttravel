<?php

use yii\db\Migration;

class m160405_145159_add_column_applicationfortours extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%application_for_tours}}', 'tourfirm_id', $this->Integer(11));
        $this->addColumn('{{%application_for_tours}}', 'manager_id', $this->Integer(11));
        $this->addColumn('{{%application_for_tours}}', 'transport_type', $this->Integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%application_for_tours}}', 'manager_id');
        $this->dropColumn('{{%application_for_tours}}', 'tourfirm_id');
        $this->dropColumn('{{%application_for_tours}}', 'transport_type');
    }
}
