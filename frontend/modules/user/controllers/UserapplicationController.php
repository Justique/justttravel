<?php

namespace frontend\modules\user\controllers;

use common\models\search\ApplicationForToursSearch;
use common\models\search\UserApplicationSearch;
use common\models\UserApplication;
use Yii;
use yii\data\Sort;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserapplicationController implements the CRUD actions for UserApplication model.
 */
class UserapplicationController extends Controller
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
     * Lists all UserApplication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserApplicationSearch();
        Yii::$app->request->queryParams = array_merge(Yii::$app->request->queryParams,['UserApplication[user_id]'=>true]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserApplication model.
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
     * Finds the UserApplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserApplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserApplication::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new UserApplication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserApplication();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserApplication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        dump(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            $responsesModel = new ApplicationForToursSearch();
            Yii::$app->request->queryParams = array_merge(Yii::$app->request->queryParams,['Application_id'=>$id]);
            $sort = new Sort([
                'attributes' => [
                    'date_create'=>[
                        'label' => 'Дате создания'
                    ],
                    'price'=>[
                        'label' => 'Цене'
                    ],
                    'nights'=>[
                        'label' => 'Количества дней'
                    ],
                ],
                'defaultOrder' => ['date_create' => SORT_ASC]
            ]);
            $responsesProvider  = $responsesModel->search(Yii::$app->request->queryParams);
//            $model = \common\models\UserApplication::find()->where(['id'=>$this->id_application])->one();
            return $this->render('update', [
                'model' => $model,
                'responsesProvider' => $responsesProvider,
            ]);
//            echo Json::encode([
//                'error'=>'Заполните все поля'
//            ]);
        }
    }

    /**
     * Deletes an existing UserApplication model.
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
