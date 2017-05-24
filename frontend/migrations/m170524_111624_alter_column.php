<?php

use yii\db\Migration;

class m170524_111624_alter_column extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%visa_order}}', 'date', $this->date());
    }

    public function down()
    {
        $this->alterColumn('{{%visa_order}}', 'date', $this->integer());
    }
}
