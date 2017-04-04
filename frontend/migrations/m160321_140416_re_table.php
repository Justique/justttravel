<?php

use yii\db\Migration;

class m160321_140416_re_table extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%companiones_interests}}', 'interests');
        $this->addColumn('{{%companiones_interests}}', 'interest_id', $this->integer(11));
        $this->addColumn('{{%companiones_interests}}', 'ord', $this->integer(10));

//        $this->addForeignKey('companiones_interests', '{{%companiones_interests}}', 'interest_id', '{{%interests}}', 'id', 'CASCADE');
    }
    public function safeDown()
    {
        $this->dropColumn('{{%companiones_interests}}', 'interest_id');
        $this->dropColumn('{{%companiones_interests}}', 'companion_id');
        $this->dropColumn('{{%companiones_interests}}', 'ord');
    }
}
