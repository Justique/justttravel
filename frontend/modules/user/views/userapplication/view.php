<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserApplication */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-application-view">

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
            'country_id',
            'city_id',
            'resort_city',
            'date',
            'price',
            'adults',
            'childrens',
            'country_from_id',
            'shopping_city',
            'user_id',
            'date_create',
            'comment:ntext',
            'is_active',
        ],
    ]) ?>

</div>
