<?php

use yii\db\Schema;
use yii\db\Migration;

class m160228_180128_add_column_tours extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tours}}', 'count_days', $this->integer(11));
        $this->addColumn('{{%tours}}', 'count_nights', $this->integer(11));
        $this->addColumn('{{%tours}}', 'transport_type', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tours}}', 'count_days');
        $this->dropColumn('{{%tours}}', 'count_nights');
        $this->dropColumn('{{%tours}}', 'transport_type');

    }
}
