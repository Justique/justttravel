<?php

namespace frontend\modules\tourfirms\controllers;
use common\models\Article;
use common\models\Cities;
use common\models\CustomerFeedback;
use common\models\ReviewsComment;
use common\models\ReviewsVotes;
use common\models\search\TourfirmsSearch;
use common\models\search\TourfirmToursSearch;
use common\models\Tourfirms;
use common\models\TourfirmsReviews;
use common\models\TourfirmVotes;
use common\models\TouroperatorsManagers;
use Yii;
use yii\data\Pagination;
use yii\data\Sort;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'rating'=>[
                    'label' => 'Рейтингу'
                ],
                'name'=>[
                    'label' => 'Алфавиту'
                ],
            ],
            'defaultOrder' => ['name' => SORT_DESC]
        ]);

        $searchModel = new TourfirmsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('tourfirms', [
            'dataProvider' => $dataProvider,
            'sort' => $sort,
            'cities' => ArrayHelper::map(Cities::findAll(['country_id' => 3]), 'id', 'city')
        ]);
    }

    public function actionView($slug)
    {
        $model = Tourfirms::find()->joinWith('tourfirmsPhon')->andWhere(['slug'=>$slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', ['model'=>$model]);
    }

    public function actionReviews($slug) {
        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
        $reviews = TourfirmsReviews::find()->where(['tourfirm_id'=>$model->id])->joinWith('user')->all();

        return $this->render('reviews', ['model'=>$model, 'reviews'=>$reviews]);
    }

    public function actionRating() {
        $model = Tourfirms::find()->andWhere(['id'=>yii::$app->request->get('tourfirm_id')])->one();
        $reviews = TourfirmsReviews::find()->where(['tourfirm_id'=>$model->id, 'user_id'=>user()->id])->one();
        $tourfirmsReviews = new TourfirmsReviews;
        $tourfirm_vote = new TourfirmVotes();
        return $this->render('rating', [
            'model'=>$model,
            'tourfirm_vote'=>$tourfirm_vote,
            'reviews'=>$reviews,
            'tourfirmsReviews'=>$tourfirmsReviews,
        ]);
    }

    public function actionReviewcomm() {
        $model = Tourfirms::find()->andWhere(['id'=>yii::$app->request->get('tourfirm_id')])->one();
        $reviews = TourfirmsReviews::find()->where(['id'=>yii::$app->request->get('reviews_id')])->one();

        return $this->render('reviewcomm', ['model'=>$model, 'reviews'=>$reviews]);
    }

    public function actionIsvotestourfirm(){
        $tourfirm_id = Yii::$app->request->get('tourfirm_id');
        $user_id = user()->id;

        $tourfirmsVotes = TourfirmVotes::find()->where(['tourfirm_id' => $tourfirm_id, 'user_id' => $user_id])->one();
        $tourfirmsReviews = TourfirmsReviews::find()->where(['tourfirm_id' => $tourfirm_id, 'user_id' => $user_id])->one();

        if (!userModel()->isUserTurist()) {
            echo Json::encode(
                [
                    'closeModal' => '#leave-report-form',
                    'errorVoteExist' => false,
                    'errorVoteOnlyTourist' => true
                ]
            );
        } elseif (!empty($tourfirmsReviews) && !empty($tourfirmsVotes)) {
            echo Json::encode(
                [
                    'closeModal' => '#leave-report-form',
                    'errorVotes' => true
                ]
            );
        } else {
            echo Json::encode(
                [
                    'redirect' => '/tourfirms/rating?tourfirm_id=' .yii::$app->request->get('tourfirm_id')
                ]
            );
        }
    }

    public function actionIsreviewtourfirm(){
        $model = Tourfirms::find()->andWhere(['id'=>yii::$app->request->get('tourfirm_id')])->one();
        $tourfirmsReviews = TourfirmsReviews::find()->where(['tourfirm_id'=>$model->id, 'user_id'=>user()->id])->one();
        if($tourfirmsReviews){
            echo Json::encode(
                [
                    'closeModal' => '#leave-report-form',
                    'error' => 'Вы уже оставляли отзыв!'
                ]
            );
        }
        else {
            return true;
        }
    }

    public function actionSavereviewcomments(){
        $model = new ReviewsComment();
        if($model->load(yii::$app->request->post()) && $model->save()){
            echo Json::encode(
                [
                    'refresh'=>'""'
                ]
            );
        }
    }

    public function actionCreatereviews(){
        if(yii::$app->request->post('TourfirmVotes')['vote']){
            TourfirmVotes::saveTourfirmVotes(yii::$app->request->post('TourfirmVotes')['vote'],yii::$app->request->post('TourfirmsReviews')['tourfirm_id']);
        }
            $model = new TourfirmsReviews();
            $find = $model->find()->where(['user_id'=>yii::$app->request->post('TourfirmsReviews')['user_id'],'tourfirm_id'=>yii::$app->request->post('TourfirmsReviews')['tourfirm_id']])->one();
                if(isset(yii::$app->request->post('TourfirmsReviews')['comment'])) {
                    if ($find) {
                        echo Json::encode(
                            [
                                'closeModal' => '#leave-report-form',
                                'error' => 'Вы уже оставляли отзыв!'
                            ]
                        );
                    } else {
                        if ($model->load(yii::$app->request->post()) && $model->save()) {
                            echo Json::encode(
                                [
                                    'closeModal' => '#leave-report-form',
                                    'redirect' => '/tourfirm/' . yii::$app->request->post('TourfirmsReviews')['slug'] . "/reviews"
                                ]
                            );
                        }
                    }
                }
                else{
                    echo Json::encode(
                        [
                            'closeModal' => '#leave-report-form',
                            'redirect' => '/tourfirm/' . yii::$app->request->post('TourfirmsReviews')['slug'] . "/reviews"
                        ]
                    );
                }
    }

    public function actionSavevotes(){
        $param = yii::$app->request->get();
        $model = ReviewsVotes::find()->where(['user_id'=>$param['user_id'],'reviews_id'=>$param['reviews_id']])->all();
        if(!$model){
            if(ReviewsVotes::saveVotes($param)){
                echo Json::encode(
                    [
                        'refresh' => '""',
                    ]
                );
            }
        }
        else {
            echo Json::encode(
                [
                    'errorVotes' => ' ',
                ]
            );
        }
    }

    public function actionManagers($id) {
        $model = TouroperatorsManagers::find()->with('profileManager','managerPhones','tourfirm')->where(['profile_touroperator_id'=>$id])->all();
        if(!$model) {
            $model = Tourfirms::find()->where(['touroperator_id'=>$id])->one();
        }
        //echo '<pre>'.print_r($model).'</pre>';
        return $this->render('managers', ['model'=>$model]);
    }

    public function actionTours($slug) {
        $sort = new Sort([
            'attributes' => [
                'created_at'=>[
                    'label' => 'Дате создания'
                ],
                'price'=>[
                    'label' => 'Цене'
                ],
                'count_nights'=>[
                    'label' => 'Количества дней'
                ],
            ],
            'defaultOrder' => ['created_at' => SORT_ASC]
        ]);

        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
//        dump($model);

        $searchModel = new TourfirmToursSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $model->id);

        return $this->render('tours', ['model'=>$model, 'dataProvider'=>$dataProvider,'sort'=>$sort]);
    }

    public function actionFeedback(){
        $model = new CustomerFeedback;
        if($model->load(Yii::$app->request->post()) && $model->save()){
                echo Json::encode(
                    [
                        'success'=>' '
                    ]
                );
        }
    }

    public function actionContact($slug) {
        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
        $modelFeedback = new CustomerFeedback;
        return $this->render('contact', ['model'=>$model, 'modelFeedback'=>$modelFeedback]);
    }

    public function actionArticle($slug) {
        $model = Tourfirms::find()->andWhere(['slug'=>$slug])->one();
        $query = Article::find()->where(['status' => 1, 'tourfirm_id'=>$model->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->where(['tourfirm_id' => $model->id])
            ->all();

        $big = Article::find()->where(['is_big'=>1, 'tourfirm_id'=>$model->id])->one();
        if (!$big) {
            throw new NotFoundHttpException('Нет большой картинки, поставьте чекбокс is_big хотя бы на одной новости');
        }
        return $this->render('news', [
            'model'=>$model,
            'models' => $models,
            'pages' => $pages,
            'big'=>$big
        ]);
    }

}
