<?php

use yii\db\Migration;

class m170404_155652_add_tariffs extends Migration
{
    public function up()
    {
        $this->insert('{{%tariffs}}', [
            'name' => 'FREE',
            'price' => 0,
            'count_tours' => 1,
            'count_up_tours' => 1,
            'count_visas' => 0,
            'count_up_visas' => 0,
            'news' => 0,
            'count_responses' => 0,
            'count_managers' => 1,
            'placement' => 1,
            'recommend' => 0,
        ]);
        $this->insert('{{%tariffs}}', [
            'name' => 'СТАРТ',
            'price' => 30,
            'count_tours' => 15,
            'count_up_tours' => 5,
            'count_visas' => 0,
            'count_up_visas' => 0,
            'news' => 0,
            'count_responses' => 5,
            'count_managers' => 1,
            'placement' => 1,
            'recommend' => 0,
        ]);
        $this->insert('{{%tariffs}}', [
            'name' => 'ОПТИМАЛ',
            'price' => 65,
            'count_tours' => 50,
            'count_up_tours' => 10,
            'count_visas' => 5,
            'count_up_visas' => 1,
            'news' => 1,
            'count_responses' => 10,
            'count_managers' => 2,
            'placement' => 1,
            'recommend' => 0,
        ]);
        $this->insert('{{%tariffs}}', [
            'name' => 'ПРОФИ',
            'price' => 125,
            'count_tours' => 110,
            'count_up_tours' => 20,
            'count_visas' => 15,
            'count_up_visas' => 5,
            'news' => 1,
            'count_responses' => 20,
            'count_managers' => 3,
            'placement' => 1,
            'recommend' => 1,
        ]);
        $this->insert('{{%tariffs}}', [
            'name' => 'МАСТЕР',
            'price' => 200,
            'count_tours' => 999,
            'count_up_tours' => 30,
            'count_visas' => 30,
            'count_up_visas' => 10,
            'news' => 1,
            'count_responses' => 999,
            'count_managers' => 4,
            'placement' => 1,
            'recommend' => 0,
        ]);
    }

    public function down()
    {
        $this->delete('{{%tariffs}}', ['name' => 'FREE']);
        $this->delete('{{%tariffs}}', ['name' => 'СТАРТ']);
        $this->delete('{{%tariffs}}', ['name' => 'ОПТИМАЛ']);
        $this->delete('{{%tariffs}}', ['name' => 'ПРОФИ']);
        $this->delete('{{%tariffs}}', ['name' => 'МАСТЕР']);
    }
}
