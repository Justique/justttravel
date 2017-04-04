<?php

namespace frontend\modules\user\controllers;

use Yii;
use common\models\TourfirmsReviews;
use yii\web\Controller;

/**
 * ToursFavoritesController implements the CRUD actions for ToursFavorits model.
 */
class TouristreviewsController extends Controller
{
    public $layout = '/profile';


    /**
     * Lists all ToursFavorits models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = TourfirmsReviews::find()->where(['user_id'=>user()->id])->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
