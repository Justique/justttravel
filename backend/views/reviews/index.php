<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'value' => function($model) {
                    return $model->user->getFullName();
                }
            ],
            [
                'attribute' => 'tourfirm_id',
                'value' => function($model) {
                    return $model->tourfirm->name;
                }
            ],
            'comment:text',
            'date_create:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{accept} {reject}',
                'buttons' => [
                    'accept' => function ($url, $model) {
                        return Html::a('Принять', ['set-status', 'id' => $model->id, 'status' => 1], [
                            'title' => 'Принять',
                            'class'=>'btn btn-primary btn-xs',
                            'data-method' => 'post',
                        ]);
                    },
                    'reject' => function ($url, $model) {
                        return Html::a('Отклонить', ['set-status', 'id' => $model->id, 'status' => 2], [
                            'title' => 'Отклонить',
                            'data-method' => 'post',
                            'class'=>'btn btn-danger btn-xs',
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>