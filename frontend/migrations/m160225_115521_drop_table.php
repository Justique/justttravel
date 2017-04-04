<?php

use yii\db\Schema;
use yii\db\Migration;

class m160225_115521_drop_table extends Migration
{
    public function up()
    {
        $this->dropTable('{{%tourfirms_users}}');
    }

}
