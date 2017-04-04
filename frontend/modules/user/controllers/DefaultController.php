<?php

namespace frontend\modules\user\controllers;

use common\base\MultiModel;
use common\models\Countries;
use frontend\modules\user\models\AccountForm;
use Intervention\Image\ImageManagerStatic;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function setLayout($layout)
    {
        $this->layout = 'frontend/views/layouts/profile';
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
            'private-messages' => [
                'class' => \vision\messages\actions\MessageApiAction::className()
            ]
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $this->layout = '/profile';
        $countries = Countries::find()->all();
        $model = Yii::$app->user->identity->userProfile;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-success'],
                'body' => Yii::t('frontend', 'Your account has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('index', compact(['model','countries']));
    }

    public function actionMessages (  )
    {
        $this->layout = '/profile';
        return $this->render('messages');

    }

    public function actionSettings()
    {
        $this->layout = '/profile';
        $accountModel = new AccountForm();
        $accountModel->setUser(Yii::$app->user->identity);
        $model = new MultiModel([
            'models' => [
                'account' => $accountModel,
                'profile' => Yii::$app->user->identity->userProfile
            ]
        ]);

        if ($accountModel->load(Yii::$app->request->post()) && $accountModel->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class'=>'alert-success'],
                'body' => Yii::t('frontend', 'Your account has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('settings', ['model'=>$model]);
    }

    public function actionPoputki(){

    }

    public function actionFavorites()
    {

    }

    public function actionCompare(){

    }

    public function actionAboutCompany(){

    }

    public function actionTours(){

    }

    public function actionManagers(){

    }

    public function actionContacts(){

    }
}
