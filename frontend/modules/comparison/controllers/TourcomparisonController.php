<?php

namespace frontend\modules\comparison\controllers;

use common\models\ToursComparison;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\Controller;

class TourcomparisonController extends Controller
{
    public $created_at;

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
                    'label' => 'Количества дней'
                ],
            ],
            'defaultOrder' => ['created_at' => SORT_ASC]
        ]);
        $query = ToursComparison::find()
            ->joinWith(['tour'])
            ->orderBy($sort->orders)
            ->andWhere(['{{%tours_comparison}}.user_id'=>user()->id]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>6]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('index', compact('models','pages','sort'));
    }

}
