<?php

use yii\db\Migration;

class m170524_112821_update_tariff extends Migration
{
    public function up()
    {
        $this->update('{{%tariffs}}', ['price' => 35], ['price' => 30]);
    }

    public function down()
    {
        $this->update('{{%tariffs}}', ['price' => 30], ['price' => 35]);
    }
}
