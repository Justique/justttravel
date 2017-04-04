<?php

namespace frontend\modules\article\controllers;

use common\models\Article;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\search\ArticleSearch;
use yii\data\Pagination;
class DefaultController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find()->where(['status' => 1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $big = Article::find()->where(['is_big'=>1])->one();
        /*if (!$big) {
            throw new NotFoundHttpException('Нет большой картинки, поставьте чекбокс is_big хотя бы на одной новости');
        }*/
        return $this->render('index',[
            'models' => $models,
            'pages' => $pages,
            'big'=>$big
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($slug)
    {
        $model = Article::find()->published()->andWhere(['slug'=>$slug])->one();
        if (!$model) {
            throw new NotFoundHttpException;
        }

        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model'=>$model]);
    }
}
