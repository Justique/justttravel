<?php

use yii\db\Schema;
use yii\db\Migration;

class m160508_111733_visa_comp_res extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%visa_comparison}}', 'tourfirm_id');
        $this->addColumn('{{%visa_comparison}}', 'tourfirm_id', $this->integer(11));
        $this->addForeignKey('visa_comparison', '{{%visa_comparison}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%visa_comparison}}', 'tourfirm_id');
    }
}
