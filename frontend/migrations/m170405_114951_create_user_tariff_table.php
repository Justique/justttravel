<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_tariff`.
 */
class m170405_114951_create_user_tariff_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_tariff}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'tariff_id' => $this->integer()->notNull(),
            'activated_at' => $this->integer(),
            'valid_at' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user_tariff}}');
    }
}
