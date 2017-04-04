<?php

use yii\db\Migration;

class m160318_143748_add_column_tourfirm extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tourfirms}}', 'latitude', $this->float());
        $this->addColumn('{{%tourfirms}}', 'longitude', $this->float());
        $this->addColumn('{{%tourfirms}}', 'radius', $this->integer(10));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tourfirms}}', 'latitude');
        $this->dropColumn('{{%tourfirms}}', 'longitude');
        $this->dropColumn('{{%tourfirms}}', 'radius');
    }
}
