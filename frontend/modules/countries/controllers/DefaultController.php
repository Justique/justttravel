<?php

namespace frontend\modules\countries\controllers;

use common\models\Countries;
use frontend\modules\countries\Module;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $alphavit = Module::getAlphavit();
        $model = Countries::find()->all();
        return $this->render('countries', [
            'model'=> $model,
            'alphavit' => $alphavit
        ]);
    }
}
