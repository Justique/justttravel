<?php

use yii\db\Schema;
use yii\db\Migration;

class m160523_101350_add_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%tourfirms_reviews}}', 'thumbnail_path', $this->string(255));
        $this->addColumn('{{%tourfirms_reviews}}', 'thumbnail_base_url', $this->string(255));
        $this->addColumn('{{%reviewsComment}}', 'thumbnail_path', $this->string(255));
        $this->addColumn('{{%reviewsComment}}', 'thumbnail_base_url', $this->string(255));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%tourfirms_reviews}}', 'thumbnail_path');
        $this->dropColumn('{{%tourfirms_reviews}}', 'thumbnail_base_url');
        $this->dropColumn('{{%reviewsComment}}', 'thumbnail_path');
        $this->dropColumn('{{%reviewsComment}}', 'thumbnail_base_url');
    }
}
