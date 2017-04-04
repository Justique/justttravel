<?php

use yii\db\Schema;
use yii\db\Migration;

class m160507_142700_tours_reset extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%tours}}', 'tourfirm_id');
        $this->addColumn('{{%tours}}', 'tourfirm_id', $this->integer(11));
        $this->addForeignKey('tours_tourfirms', '{{%tours}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'tourfirm_id');
    }
}
