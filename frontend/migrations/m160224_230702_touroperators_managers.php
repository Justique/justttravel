<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_230702_touroperators_managers extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%touroperators_managers}}', [
            'manager_id' => $this->primaryKey()->notNull(),
            'profile_touroperator_id' => $this->integer(11)->notNull(),
            'profile_manager_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('profile_touroperator_id', '{{%touroperators_managers}}', 'profile_touroperator_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('profile_manager_id', '{{%touroperators_managers}}', 'profile_manager_id', '{{%user}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%users_managers}}');
    }
}
