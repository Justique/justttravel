<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\UserTariff;
use yii\helpers\Console;

class TariffsController extends Controller
{
    public function actionCheck()
    {
        /** @var \common\models\UserTariff[] $tariffs */
        $tariffs = UserTariff::find()->where(['<', 'valid_at', date('Y-m-d')])->all();
        if ($tariffs) {
            foreach ($tariffs as $tariff) {
                if ($tariff->tariff->price > 0) {
                    $tariff->tariff_id = 1;
                    $tariff->valid_at = null;
                    $tariff->save();

                    // убрать менеджеров, туры, визы
                }
            }
        }
        Console::output("Done!");
    }
}