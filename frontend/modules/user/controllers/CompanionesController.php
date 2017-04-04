<?php

namespace frontend\modules\user\controllers;

use common\models\Companiones;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CompanionesController implements the CRUD actions for Companiones model.
 */
class CompanionesController extends Controller
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
     * Lists all Companiones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $myCompaniones = Companiones::find()->joinWith('myCompaniones')->where(['tbl_companiones.user_id'=>user()->id])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Companiones::find()->where(['user_id'=>user()->id]),
        ]);
        return $this->actionCreate();
//        return $this->render('create', [
//            'dataProvider' => $dataProvider,
//            'myCompaniones' => $myCompaniones
//        ]);
    }

    /**
     * Displays a single Companiones model.
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
     * Finds the Companiones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Companiones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Companiones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Companiones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Companiones();
        $myCompaniones = Companiones::find()->joinWith('myCompaniones')->where(['tbl_companiones.user_id'=>user()->id])->all();
//        dump($_POST);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'id' => $model->id, 'myCompaniones' => $myCompaniones]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'myCompaniones' => $myCompaniones,
            ]);
        }
    }

    /**
     * Updates an existing Companiones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $myCompaniones = Companiones::find()->joinWith('myCompaniones')->where(['tbl_companiones.user_id'=>user()->id])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Companiones::updateCompanionesCompany($model->id, Yii::$app->request->post('CompanionesCompany'));
            return $this->redirect(['index', 'id' => $model->id,'myCompaniones' => $myCompaniones,]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'myCompaniones' => $myCompaniones,
            ]);
        }
    }

    /**
     * Deletes an existing Companiones model.
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
