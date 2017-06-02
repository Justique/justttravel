<?php

use yii\db\Migration;

class m170601_133653_alter_columns extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%user_tariff}}', 'user_id', $this->integer()->unique()->notNull());
        $this->alterColumn('{{%user_tariff}}', 'valid_at', $this->date());
        $this->dropColumn('{{%user_tariff}}', 'activated_at');
        $this->createIndex('idx-user_tariff-user_id', '{{%user_tariff}}', 'user_id');
        $this->createIndex('idx-user_tariff-tariff_id', '{{%user_tariff}}', 'tariff_id');
        $this->addForeignKey('fk-user_tariff-user_id', '{{%user_tariff}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk-user_tariff-tariff_id', '{{%user_tariff}}', 'tariff_id', '{{%tariffs}}', 'id');
    }

    public function down()
    {
        $this->alterColumn('{{%user_tariff}}', 'user_id', $this->integer()->notNull());
        $this->alterColumn('{{%user_tariff}}', 'valid_at', $this->integer());
        $this->addColumn('{{%user_tariff}}', 'activated_at', $this->integer());
        $this->dropForeignKey('fk-user_tariff-user_id', '{{%user_tariff}}');
        $this->dropForeignKey('fk-user_tariff-tariff_id', '{{%user_tariff}}');
        $this->dropIndex('user_id', '{{%user_tariff}}');
        $this->dropIndex('idx-user_tariff-user_id', '{{%user_tariff}}');
        $this->dropIndex('idx-user_tariff-tariff_id', '{{%user_tariff}}');
    }
}
