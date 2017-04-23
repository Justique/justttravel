<?php

namespace frontend\modules\companions\controllers;

use yii;
use yii\data\Pagination;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use common\models\Companiones;
use common\models\Interests;
use common\models\Countries;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $query = Companiones::find();
        $where = [];
        if(!empty(yii::$app->request->get('interest_name'))){
            $model = Interests::find()->where(['name'=>yii::$app->request->get('interest_name')])->joinWith('companiones')->all();
            if($model){
                $ids = [];
                foreach($model as $item){
                    if($item) {
                        foreach ($item->companiones as $id) {
                            $ids[] = $id->companion_id;
                        }
                    }
                }
                if($ids){
                    $where = ['id'=>$ids];
                }
            }
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>10]);
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->where($where)
            ->all();

        return $this->render('companiones', [
            'companions' => $model,
            'pages' => $pages,
            'countries' => ArrayHelper::map(Countries::find()->all(), 'country_id', 'name')
        ]);
    }
}
