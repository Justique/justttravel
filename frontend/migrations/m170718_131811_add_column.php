<?php

use yii\db\Migration;

class m170718_131811_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%tourfirms}}', 'photo_path', $this->string()->after('id'));
    }

    public function down()
    {
        $this->dropColumn('{{%tourfirms}}', 'photo_path');
    }
}
