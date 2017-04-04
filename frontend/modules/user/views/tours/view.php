<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tours */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Туры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="head-symbol"><i class="fa fa-commenting"></i></div>
<h1><?= Html::encode($this->title) ?></h1>
<div class="tours-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'slug',
            'status',
            'price',
            'country_to_id',
            'city_to_id',
            'city_from_id',
            'date_from',
            'count_old',
            'count_kids',
            'hotel_id',
            'user_id',
            'body:ntext',
            'thumbnail_base_url:url',
            'thumbnail_path',
            'created_at',
            'published_at',
        ],
    ]) ?>

</div>
