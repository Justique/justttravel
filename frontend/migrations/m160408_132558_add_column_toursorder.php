<?php

use yii\db\Migration;

class m160408_132558_add_column_toursorder extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tours_order}}', 'tourfirm_id', $this->Integer(11));
        $this->addColumn('{{%visa_order}}', 'tourfirm_id', $this->Integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours_order}}', 'tourfirm_id');
        $this->dropColumn('{{%visa_order}}', 'tourfirm_id');
    }
}
