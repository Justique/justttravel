<?php

use yii\db\Schema;
use yii\db\Migration;

class m160220_150903_add_column_visa extends Migration
{
//    public function up()
//    {
//
//    }
//
//    public function down()
//    {
//        echo "m160220_150903_add_column_visa cannot be reverted.\n";
//w
//        return false;
//    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction

    */
    public function safeUp()
    {
        $this->addColumn('{{%visa}}', 'city_id', $this->integer(11));
        $this->addColumn('{{%visa}}', 'documents', $this->string(200), 'CHARACTER SET utf8');
        $this->addColumn('{{%visa}}', 'registration_period', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%visa}}', 'city_id');
        $this->dropColumn('{{%visa}}', 'documents');
        $this->dropColumn('{{%visa}}', 'registration_period');
    }
}
