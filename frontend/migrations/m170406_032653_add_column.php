<?php

use yii\db\Migration;

class m170406_032653_add_column extends Migration
{
    public function up()
    {
        $this->renameColumn('{{%tours}}', 'published_at', 'updated_at');
        $this->addColumn('{{%visa}}', 'published_at', $this->integer()->notNull()->after('date_update'));
        $this->addColumn('{{%tours}}', 'published_at', $this->integer()->notNull()->after('updated_at'));
    }

    public function down()
    {
        $this->dropColumn('{{%visa}}', 'published_at');
        $this->dropColumn('{{%tours}}', 'updated_at');
    }
}
