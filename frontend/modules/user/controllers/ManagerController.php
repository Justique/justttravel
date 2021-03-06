<?php

namespace frontend\modules\user\controllers;

use common\models\ManagersPhone;
use common\models\TouroperatorsManagers;
use common\models\User;
use common\models\UserProfile;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use frontend\modules\user\models\TourfirmUserSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ManagerController implements the CRUD actions for User model.
 */
class ManagerController extends Controller
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
     * @return array
     */
    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::className(),
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::className()
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = '/profile';

        $searchModel = new TourfirmUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'canCreate' => userModel()->tariff->canCreateManagers(),
        ]);
    }

    /**
     * Displays a single User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (userModel()->tariff->canCreateManagers()) {
            $this->layout = '/profile';
            $model = new User();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->setPassword(Yii::$app->request->post('User')['password_hash']);
                if ($model->save()) {
                    $post = Yii::$app->request->post();
                    $lastId = yii::$app->db->lastInsertID;
                    TouroperatorsManagers::saveUsersManagers(user()->id, $lastId);
                    ManagersPhone::savePhoneManager($this->getModelManagersPhone(), $post, $lastId);
                    UserProfile::saveManager($lastId);
                    $model->userProfile->load(Yii::$app->request->post());
                    $model->userProfile->save();
                    return $this->redirect(['index', 'id' => $model->id]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'modelManagerPhone' => $this->getModelManagersPhone(),
                ]);
            }
        } else {
            return $this->redirect(['index']);
        }
    }

    public function getModelManagersPhone() {
        return new ManagersPhone();
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = '/profile';
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword(Yii::$app->request->post('User')['password_hash']);
            if($model->save()){
                ManagersPhone::updatePhoneManager($this->getModelManagersPhone(),$id, Yii::$app->request->post());
                $model->userProfile->load(Yii::$app->request->post());
                $model->userProfile->save();
            }
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelManagerPhone' => $this->getModelManagersPhone()->findOne(['manager_id'=>$id])
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
