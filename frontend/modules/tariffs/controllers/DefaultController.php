<?php

namespace frontend\modules\tariffs\controllers;

use Yii;
use common\models\Tariffs;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [
            'tariffs'=> Tariffs::find()->all()
        ]);
    }
}
