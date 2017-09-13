<?php

use yii\db\Migration;

class m170913_134639_add_vote_count_to_reviews extends Migration
{
    public function up()
    {
		$this->addColumn('{{%tourfirms_reviews}}', 'vote', $this->integer()->after('status'));
    }

    public function down()
    {
        echo "m170913_134639_add_vote_count_to_reviews cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
