<?php

use yii\db\Schema;
use yii\db\Migration;

class m160316_214216_change_column extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%tourfirms}}', 'rating');
        $this->addColumn('{{%tourfirms}}', 'rating', $this->float());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tourfirms}}', 'rating');
    }
}
