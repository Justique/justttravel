<?php

namespace frontend\modules\user\controllers;

use common\models\search\TourfirmsUserSearch;
use common\models\Tourfirms;
use common\models\TourfirmsPhons;
use common\models\TourfirmWorkTime;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TourfirmsController implements the CRUD actions for Tourfirms model.
 */
class TourfirmsController extends Controller
{
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
     * Lists all Tourfirms models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(\common\models\Tourfirms::getTourfirmId(user()->id)){
           return $this->actionUpdate(\common\models\Tourfirms::getTourfirmId(user()->id));
        }
        else{
           return $this->actionCreate();
        }

    }

    /**
     * Displays a single Tourfirms model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '/profile';
        $modelPhons = User::getModelPage(TourfirmsPhons::className(), 'tourfirm_id');;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelPhons' => $modelPhons
        ]);
    }

    /**
     * Finds the Tourfirms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tourfirms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tourfirms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Tourfirms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = '/profile';
        $model = new Tourfirms();
        $modelPhons = new TourfirmsPhons();
        $modelWorkTime = new TourfirmWorkTime();
        if ($model->load(Yii::$app->request->post()) &&
            $modelPhons->load(Yii::$app->request->post()) &&
            $modelWorkTime->load(Yii::$app->request->post()) ) {
            $model->save();
            $modelPhons->save();
            $modelWorkTime->save();

            return $this->actionIndex();
//            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelPhons' => $modelPhons,
                'modelWorkTime' => $modelWorkTime,
            ]);
        }
    }

    /**
     * Updates an existing Tourfirms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = '/profile';
        $model = $this->findModel($id);
        $modelPhons = User::getModelPage(TourfirmsPhons::className(), 'tourfirm_id');
        //========================

        $modelWorkTime = User::getModelPage(TourfirmWorkTime::className(), 'tourfirm_id');
        //dump(Yii::$app->request->post());
        //========================
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Tourfirms::updateData(Tourfirms::getTourfirmId(user()->id), Yii::$app->request->post());
            $modelWorkTime->save();
        }
        return $this->render('update', [
            'model' => $model,
            'modelPhons' => $modelPhons,
            'modelWorkTime' => $modelWorkTime,
        ]);
    }

    /**
     * Deletes an existing Tourfirms model.
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
