<?php

namespace backend\controllers;

use common\models\UserTariff;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use common\models\Tourfirms;
use common\models\Tariffs;

/**
 * UserController implements the CRUD actions for Tourfirms model.
 */
class TourfirmsController extends Controller
{
    /**
     * Lists all Tourfirms models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Tourfirms::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->touroperator->tariff->valid_at == '0000-00-00') {
            $model->touroperator->tariff->valid_at = null;
        }
        if ($model->load(Yii::$app->request->post()) && $model->touroperator->tariff->load(Yii::$app->request->post())) {
            if ($model->touroperator->tariff->tariff_id == 1) {
                $model->touroperator->tariff->valid_at = null;
            }
            $model->save();
            $model->touroperator->tariff->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'tariffs' => ArrayHelper::map(Tariffs::find()->all(), 'id', 'name')
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Tourfirms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}