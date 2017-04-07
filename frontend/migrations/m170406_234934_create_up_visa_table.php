<?php

use yii\db\Migration;

/**
 * Handles the creation of table `up_visa`.
 */
class m170406_234934_create_up_visa_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%up_visa}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'visa_id' => $this->integer()->notNull(),
            'timestamp' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%up_visa}}');
    }
}
