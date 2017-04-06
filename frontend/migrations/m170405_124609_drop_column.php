<?php

use yii\db\Migration;

class m170405_124609_drop_column extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%user_profile}}', 'tariff');
    }

    public function down()
    {
        $this->addColumn('{{%user_profile}}', 'tariff', $this->smallInteger()->after('company'));
    }
}
