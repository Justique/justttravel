<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_151547_companiones_company_add_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%companiones_company}}', 'company', $this->string(50));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%companiones_company}}', 'company');
    }
}
