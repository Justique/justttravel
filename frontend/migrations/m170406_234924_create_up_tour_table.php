<?php

use yii\db\Migration;

/**
 * Handles the creation of table `up_tour`.
 */
class m170406_234924_create_up_tour_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%up_tour}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'tour_id' => $this->integer()->notNull(),
            'timestamp' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%up_tour}}');
    }
}
