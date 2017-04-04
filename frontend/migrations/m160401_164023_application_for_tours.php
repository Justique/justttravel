<?php

use yii\db\Migration;

class m160401_164023_application_for_tours extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%application_for_tours}}', [
            'id' => $this->primaryKey()->notNull(),
            'country_to_id' => $this->integer(11)->notNull(),
            'city_to_id' => $this->integer(11)->notNull(),
            'date' => $this->string(255)->notNull(),
            'price' => $this->integer(11)->notNull(),
            'adults' => $this->integer(2)->notNull(),
            'childrens' => $this->integer(2),
            'country_from_id' => $this->integer(11)->notNull(),
            'city_from_id' => $this->integer(11)->notNull(),
            'user_application_id' => $this->integer(11)->notNull(),
            'date_create' => $this->integer(11),
            'date_update' => $this->integer(11),
        ]);
    }
    public function safeDown()
    {
        $this->dropTable('{{%application_for_tours}}');
    }
}
