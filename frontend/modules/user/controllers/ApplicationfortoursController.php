<?php

namespace frontend\modules\user\controllers;

use common\models\ApplicationForTours;
use common\models\search\UserApplicationSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ApplicationForToursController implements the CRUD actions for ApplicationForTours model.
 */
class ApplicationfortoursController extends Controller
{
    public $layout = '/profile';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ApplicationForTours models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserApplicationSearch();
        Yii::$app->request->queryParams = array_merge(Yii::$app->request->queryParams,['Applicationfortours[is_active]'=>1]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApplicationForTours model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the ApplicationForTours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ApplicationForTours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApplicationForTours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new ApplicationForTours model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ApplicationForTours();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'success'=>'Заявка создана'
            ]);
        } else {
            echo Json::encode([
                'error'=>'Заполните все поля'
            ]);
        }
    }

    /**
     * Updates an existing ApplicationForTours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                echo Json::encode([
                    'success'=>'Заявка обновлена'
                ]);
            } else {
                echo Json::encode([
                    'error'=>'Заполните все поля'
                ]);
            }
    }

    /**
     * Deletes an existing ApplicationForTours model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
