<?php

use yii\db\Migration;

class m170508_121702_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_application}}', 'hotels', $this->text()->after('nights'));
    }

    public function down()
    {
        $this->dropColumn('{{%user_application}}', 'hotels');
    }
}
