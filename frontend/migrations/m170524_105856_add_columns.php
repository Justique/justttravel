<?php

use yii\db\Migration;

class m170524_105856_add_columns extends Migration
{
    public function up()
    {
        $this->addColumn('{{%tours_order}}', 'phone', $this->string()->after('email'));
        $this->addColumn('{{%tours_order}}', 'skype', $this->string()->after('phone'));
        $this->addColumn('{{%tours_order}}', 'count_kids', $this->integer()->defaultValue(0)->after('skype'));
        $this->addColumn('{{%tours_order}}', 'count_old', $this->integer()->defaultValue(0)->after('count_kids'));
        $this->addColumn('{{%tours_order}}', 'comment', $this->text()->after('count_old'));
    }

    public function down()
    {
        $this->dropColumn('{{%tours_order}}', 'phone');
        $this->dropColumn('{{%tours_order}}', 'skype');
        $this->dropColumn('{{%tours_order}}', 'count_kids');
        $this->dropColumn('{{%tours_order}}', 'count_old');
        $this->dropColumn('{{%tours_order}}', 'comment');
    }
}
