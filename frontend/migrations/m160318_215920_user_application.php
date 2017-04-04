<?php

use yii\db\Migration;

class m160318_215920_user_application extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user_application}}', [
            'id' => $this->primaryKey()->notNull(),
            'country_id' => $this->integer(11)->notNull(),
            'city_id' => $this->integer(11)->notNull(),
            'resort_city' => $this->integer(11)->notNull(),
            'date' => $this->string(255)->notNull(),
            'price' => $this->integer(11)->notNull(),
            'adults' => $this->integer(2)->notNull(),
            'childrens' => $this->integer(2),
            'country_from_id' => $this->integer(11)->notNull(),
            'shopping_city' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'date_create' => $this->integer(11),
            'date_update' => $this->integer(11),
            'comment' => $this->text(),
            'is_active' => $this->smallInteger(1),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_application}}');
    }
}
