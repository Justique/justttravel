<?php

use yii\db\Migration;

class m170913_120432_add_column_to_tourfirm_votes extends Migration
{
    public function up()
    {
		$this->addColumn('{{%tourfirm_votes}}', 'review_id', $this->integer()->after('tourfirm_id'));
    }

    public function down()
    {
        echo "m170913_120432_add_column_to_tourfirm_votes cannot be reverted.\n";

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
