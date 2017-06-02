<?php

namespace backend\controllers;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TourfirmsReviews;

/**
 * UserController implements the CRUD actions for User model.
 */
class ReviewsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'set-status' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = TourfirmsReviews::find();
        $query->andWhere(['status' => 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSetStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        $model->save();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = TourfirmsReviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}