<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tariffs`.
 */
class m170404_154016_create_tariffs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%tariffs}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer()->defaultValue(0)->notNull(),
            'count_tours' => $this->integer()->defaultValue(0),
            'count_up_tours' => $this->integer()->defaultValue(0),
            'count_visas' => $this->integer()->defaultValue(0),
            'count_up_visas' => $this->integer()->defaultValue(0),
            'news' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'count_responses' => $this->integer()->defaultValue(0),
            'count_managers' => $this->integer()->defaultValue(0),
            'placement' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'recommend' => $this->smallInteger(1)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%tariffs}}');
    }
}
