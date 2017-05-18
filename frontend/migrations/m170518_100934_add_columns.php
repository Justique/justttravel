<?php

use yii\db\Migration;

class m170518_100934_add_columns extends Migration
{
    public function up()
    {
        $this->addColumn('{{%visa_order}}', 'phone', $this->string()->after('email'));
        $this->addColumn('{{%visa_order}}', 'skype', $this->string()->after('phone'));
        $this->addColumn('{{%visa_order}}', 'count_kids', $this->integer()->defaultValue(0)->after('skype'));
        $this->addColumn('{{%visa_order}}', 'count_old', $this->integer()->defaultValue(0)->after('count_kids'));
        $this->addColumn('{{%visa_order}}', 'date', $this->integer()->after('count_old'));
        $this->addColumn('{{%visa_order}}', 'comment', $this->text()->after('date'));
    }

    public function down()
    {
        $this->dropColumn('{{%visa_order}}', 'phone');
        $this->dropColumn('{{%visa_order}}', 'skype');
        $this->dropColumn('{{%visa_order}}', 'count_kids');
        $this->dropColumn('{{%visa_order}}', 'count_old');
        $this->dropColumn('{{%visa_order}}', 'date');
        $this->dropColumn('{{%visa_order}}', 'comment');
    }
}
