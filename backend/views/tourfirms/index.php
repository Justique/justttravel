<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Tourfirms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tourfirms-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'raw',
                'attribute' => 'name',
                'value' => function ($model) {
                    return Html::a($model->name, ['update', 'id' => $model->id]);
                },
            ],
            [
                'format' => 'raw',
                'attribute' => 'touroperator_id',
                'value' => function ($model) {
                    return $model->touroperator->username;
                },
            ],
        ],
    ]); ?>

</div>
