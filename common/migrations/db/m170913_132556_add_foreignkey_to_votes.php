<?php

use yii\db\Migration;

class m170913_132556_add_foreignkey_to_votes extends Migration
{
    public function up()
    {
		$this->addForeignKey('fk_review_id', '{{%tourfirm_votes}}', 'review_id', '{{%tourfirms_reviews}}', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        echo "m170913_132556_add_foreignkey_to_votes cannot be reverted.\n";

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
