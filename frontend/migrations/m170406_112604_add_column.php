<?php

use yii\db\Migration;

class m170406_112604_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%application_for_tours}}', 'user_id', $this->integer()->notNull()->after('tourfirm_id'));
    }

    public function down()
    {
        $this->dropColumn('{{%application_for_tours}}', 'user_id');
    }
}
