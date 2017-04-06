<?php

use yii\db\Migration;

/**
 * Handles the creation of table `payment`.
 */
class m170405_121906_create_payment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'tariff_id' => $this->integer()->defaultValue(null),
            'month_count' => $this->integer()->defaultValue(null),
            'name' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
            'discount' => $this->integer()->defaultValue(0),
            'total' => $this->double()->notNull(),
            'payment_at' => $this->integer(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%payment}}');
    }
}
