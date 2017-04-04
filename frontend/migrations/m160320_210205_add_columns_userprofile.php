<?php

use yii\db\Migration;

class m160320_210205_add_columns_userprofile extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%user_profile}}', 'phone', $this->string(255));
        $this->addColumn('{{%user_profile}}', 'fullname', $this->string(255));
        $this->addColumn('{{%user_profile}}', 'address', $this->string(255));
        $this->addColumn('{{%user_profile}}', 'ur_address', $this->string(255));
        $this->addColumn('{{%user_profile}}', 'company', $this->string(255));
        $this->addColumn('{{%user_profile}}', 'tariff', $this->smallInteger(1));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%user_profile}}', 'phone');
        $this->dropColumn('{{%user_profile}}', 'address');
        $this->dropColumn('{{%user_profile}}', 'ur_address');
        $this->dropColumn('{{%user_profile}}', 'company');
        $this->dropColumn('{{%user_profile}}', 'tariff');
    }
}
