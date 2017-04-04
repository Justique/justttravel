<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ApplicationForTours */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Application For Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-for-tours-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'country_to_id',
            'city_to_id',
            'date',
            'price',
            'adults',
            'childrens',
            'country_from_id',
            'city_from_id',
            'user_application_id',
            'date_create',
            'date_update',
        ],
    ]) ?>

</div>
