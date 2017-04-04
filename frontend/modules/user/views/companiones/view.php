<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Companiones */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Companiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companiones-view">

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
            'user_id',
            'age_with',
            'age_to',
            'type_travel_id',
            'purpose_travel',
            'about_me',
            'about_traveler',
            'travel_location',
            'gender_traveler',
            'iterests',
        ],
    ]) ?>

</div>
