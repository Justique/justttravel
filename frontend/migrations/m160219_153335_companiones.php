<?php

use yii\db\Schema;
use yii\db\Migration;

class m160219_153335_companiones extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%companiones}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11),
            'age_with'=> $this->integer(10),
            'age_to'=> $this->integer(10),
            'type_travel_id' => $this->integer(11),
            'purpose_travel' => $this->string(200),
            'about_me' => $this->string(200),
            'about_traveler' => $this->string(200),
            'travel_location' => $this->string(200),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%companiones}}');
    }
}
