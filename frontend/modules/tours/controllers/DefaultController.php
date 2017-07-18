<?php

namespace frontend\modules\tours\controllers;

use common\models\search\ToursSearch;
use common\models\Tours;
use common\models\ToursComparison;
use common\models\ToursFavorits;
use common\models\ToursOrder;
use common\models\Countries;
use common\models\Cities;
use yii;
use yii\data\Sort;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

class DefaultController extends Controller
{
    public function actionIndex()
    {

        $sort = new Sort([
            'attributes' => [
                'created_at'=>[
                    'label' => 'Дате создания'
                ],
                'price'=>[
                    'label' => 'Цене'
                ],
                'count_nights'=>[
                    'label' => 'Количеству дней'
                ],
            ],
            'defaultOrder' => ['created_at' => SORT_ASC]
        ]);

        $searchModel = new ToursSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('tours',[
            'dataProvider'=>$dataProvider,
            'sort'=>$sort,
            'countries'=> ArrayHelper::map(Countries::find()->all(), 'country_id', 'name'),
            'cities' => ArrayHelper::map(Cities::findAll(['country_id' => 3]), 'id', 'city')
        ]);
    }

    public function actionView($slug)
    {
        $model = Tours::find()->andWhere(['slug'=>$slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', ['model'=>$model]);
    }

    public function actionFavorits(){
        $model = new ToursFavorits();
        if(yii::$app->request->get('save') == 1){
            $count = $model::find()->where(['user_id'=>user()->id, 'tour_id'=>yii::$app->request->get('tour_id')])->one();
            if(!$count){
                $model->user_id = user()->id;
                $model->tour_id = yii::$app->request->get('tour_id');
                $model->save();
            }
        }
        else{
            if($model->deleteAll(['tour_id'=>yii::$app->request->get('tour_id')])) {
            }
        }
        echo yii\helpers\Json::encode(['refresh'=>'""']);
    }

    public function actionComparison(){
        $model = new ToursComparison();
        if(yii::$app->request->get('comparison_save') == 1){
            $count = $model::find()->where(['user_id'=>user()->id, 'tour_id'=>yii::$app->request->get('tour_id')])->one();
            if(!$count){
                $model->user_id = user()->id;
                $model->tour_id = yii::$app->request->get('tour_id');
                $model->tourfirm_id = yii::$app->request->get('tourfirm_id');
                $model->save();
            }
        }
        else{
            if($model->deleteAll(['tour_id'=>yii::$app->request->get('tour_id')])) {
            }
        }
        echo yii\helpers\Json::encode(['refresh'=>'""']);
    }

    public function actionOrder(){

        $model = new ToursOrder();
        $find = $model->find()->where(['user_id'=>yii::$app->request->post('ToursOrder')['user_id'],'tour_id'=>yii::$app->request->post('ToursOrder')['tour_id']])->one();
        if($find){
            echo yii\helpers\Json::encode(
                [
                    'closeModal'=>'#order_tour',
                    'error'=>'Вы уже заказали этот тур! '
                ]
            );
        }else{
            if($model->load(yii::$app->request->post()) && $model->save()){
                $message_text = "
                    <b>Имя:</b>$model->name<br>
                    <b>Email:</b>$model->email<br>
                    <b>Телефон:</b>$model->phone<br>
                    <b>Skype/Viber/WhatsApp:</b>$model->skype<br>
                    <b>Кол-во детей:</b>$model->count_kids<br>
                    <b>Кол-во взрослых:</b>$model->count_old<br>
                    <b>Примерная дата:</b>$model->date<br>
                    <b>Комментарий:</b>$model->comment<br>
                ";
                \Yii::$app->mailer->compose()
                    ->setTo($model->tour->tourfirm->touroperator->email)
                    ->setReplyTo([$model->email => $model->name])
                    ->setSubject('Заказ тура с сайта justtravel.by')
                    ->setHtmlBody($message_text)
                    ->send();
                echo yii\helpers\Json::encode(
                    [
                        'closeModal'=>'#order_tour',
                        'success'=>' '
                    ]
                );
            }
        }

//        dump(yii::$app->request->post());
    }
}
