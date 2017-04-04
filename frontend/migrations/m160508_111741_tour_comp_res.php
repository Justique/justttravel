<?php

use yii\db\Schema;
use yii\db\Migration;

class m160508_111741_tour_comp_res extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%tours_comparison}}', 'tourfirm_id');
        $this->addColumn('{{%tours_comparison}}', 'tourfirm_id', $this->integer(11));
        $this->addForeignKey('tours_comparison', '{{%tours_comparison}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours_comparison}}', 'tourfirm_id');
    }
}
