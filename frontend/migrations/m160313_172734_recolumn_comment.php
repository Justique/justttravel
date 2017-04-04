<?php

use yii\db\Schema;
use yii\db\Migration;

class m160313_172734_recolumn_comment extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%reviewsComment}}', 'comment');
        $this->dropColumn('{{%tourfirms_reviews}}', 'comment');
        $this->addColumn('{{%reviewsComment}}', 'comment', $this->text());
        $this->addColumn('{{%tourfirms_reviews}}', 'comment', $this->text());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%reviewsComment}}', 'comment');
        $this->dropColumn('{{%tourfirms_reviews}}', 'comment');
    }
}
