<?php

use yii\db\Schema;
use yii\db\Migration;

class m160221_174823_add_column_companiones extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%companiones}}', 'gender_traveler', $this->string(200));
        $this->addColumn('{{%companiones}}', 'interests', $this->string(200));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%companiones }}', 'gender_traveler');
        $this->dropColumn('{{%companiones }}', 'interests');
    }
}
