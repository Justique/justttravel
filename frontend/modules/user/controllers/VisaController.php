<?php

namespace frontend\modules\user\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\search\VisaSearch;
use common\models\Tourfirms;
use common\models\Visa;
use common\models\UpVisa;

/**
 * VisaController implements the CRUD actions for Visa model.
 */
class VisaController extends Controller
{

    public $layout = '/profile';

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
     * Lists all Visa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $flagTourfirm = Tourfirms::getTourfirmId(user()->id);
        $searchModel = new VisaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $flagTourfirm);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'flagTourfirm' => $flagTourfirm,
            'canCreate' => userModel()->tariff->canCreateVisa(),
        ]);
    }

    /**
     * Displays a single Visa model.
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
     * Finds the Visa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Visa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Visa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (userModel()->tariff->canCreateVisa()) {
            $model = new Visa();
            if ($model->load(Yii::$app->request->post())) {
                $model->user_id = userModel()->id;
                if ($model->save()) {
                    return $this->actionIndex();
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Visa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing Visa model.
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
        if (userModel()->tariff->canUpVisa()) {
            $model = $this->findModel($id);
            $model->published_at = time();
            if ($model->save()) {
                $up = new UpVisa();
                $up->user_id = userModel()->id;
                $up->visa_id = $model->id;
                $up->timestamp = time();
                $up->save();
            }
        }
        return $this->redirect(['index']);
    }
}
