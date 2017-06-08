<?php

namespace frontend\modules\user\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\search\TourfirmToursSearch;
use common\models\Tourfirms;
use common\models\Tours;
use common\models\UpTour;

/**
 * ToursController implements the CRUD actions for Tours model.
 */
class ToursController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'up' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tours models.
     * @return mixed
     */
    public function actionIndex()
    {

        $this->layout = '/profile';
        $searchModel = new TourfirmToursSearch();
        $flagTourfirm = Tourfirms::getTourfirmId(user()->id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$flagTourfirm);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->getTourfirms(),
            'flagTourfirm' => $flagTourfirm,
            'canCreate' => userModel()->tariff && userModel()->tariff->canCreateTour(),
            'canUp' => userModel()->tariff && userModel()->tariff->canUpTour(),
        ]);
    }

    public function getTourfirms(){
        $tourfirm_id = Tourfirms::getTourfirmId(user()->id);
        $modelTourFirm = Tours::find()->where(['tourfirm_id'=>$tourfirm_id])->all();
        return $modelTourFirm;
    }

    /**
     * Displays a single Tours model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '/profile';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Tours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Tours model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (userModel()->tariff && userModel()->tariff->canCreateTour()) {
            $this->layout = '/profile';
            $model = new Tours();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Tours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = '/profile';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tours model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUp($id) {
        if (userModel()->tariff && userModel()->tariff->canUpTour()) {
            $model = $this->findModel($id);
            $model->price = (string)$model->price;
            $model->published_at = time();
            if ($model->save()) {
                $up = new UpTour();
                $up->user_id = userModel()->id;
                $up->tour_id = $model->id;
                $up->timestamp = time();
                $up->save();
            }
        }
        return $this->redirect(['index']);
    }
}
