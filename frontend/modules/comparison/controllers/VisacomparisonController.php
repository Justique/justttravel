<?php

namespace frontend\modules\comparison\controllers;

use common\models\VisaComparison;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\Controller;

class VisacomparisonController extends Controller
{
    public $created_at;

    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'date_create'=>[
                    'label' => 'Дате создания'
                ],
                'price'=>[
                    'label' => 'Цене'
                ],
            ],
            'defaultOrder' => ['date_create' => SORT_ASC]
        ]);
        $query = VisaComparison::find()
            ->joinWith(['visa'])
            ->orderBy($sort->orders)
            ->andWhere(['{{%visa_comparison}}.user_id'=>user()->id]);



        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>6]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();

        return $this->render('index', compact('models','pages','sort'));
    }

}
