<?php

use yii\db\Schema;
use yii\db\Migration;

class m160219_151538_visa extends Migration
{
//    public function up()
//    {
//
//    }
//
//    public function down()
//    {
//        echo "m160219_151538_visa cannot be reverted.\n";
//
//        return false;
//    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction

    */
    public function safeUp()
    {
        $this->createTable('{{%visa}}', [
            'id' => $this->primaryKey()->notNull(),
            'description' => $this->string(255)->notNull(),
            'country_id' => $this->integer(11),
            'tour_id' => $this->integer(11),
            'price' => $this->integer(11),
            'date_create' => $this->integer(11)->notNull(),
            'date_update' => $this->integer(11)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%visa}}');
    }
}
