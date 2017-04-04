<?php

use yii\db\Schema;
use yii\db\Migration;

class m160316_135447_tourfirm_votes extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%tourfirm_votes}}', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'tourfirm_id' => $this->integer(11)->notNull(),
            'vote' => $this->smallInteger(1)->notNull(),
        ]);
        $this->addForeignKey('tourfirm_votes', '{{%tourfirm_votes}}', 'tourfirm_id', '{{%tourfirms}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%tourfirm_votes}}');
    }
}
