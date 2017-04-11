<?php

use yii\db\Migration;

class m170411_135511_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%payment}}', 'invoice_id', $this->integer()->after('payment_at'));
    }

    public function down()
    {
        $this->dropColumn('{{%payment}}', 'invoice_id');
    }
}
