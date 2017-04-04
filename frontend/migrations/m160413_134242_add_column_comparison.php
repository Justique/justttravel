<?php

use yii\db\Migration;

class m160413_134242_add_column_comparison extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tours_comparison}}', 'tourfirm_id', $this->Integer(11));
        $this->addColumn('{{%visa_comparison}}', 'tourfirm_id', $this->Integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours_comparison}}', 'tourfirm_id');
        $this->dropColumn('{{%visa_comparison}}', 'tourfirm_id');
    }
}
