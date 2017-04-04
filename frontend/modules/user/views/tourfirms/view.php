<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Tourfirms */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tourfirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tourfirms-view">

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
            'description:ntext',
            'address',
            'name',
            [
                'label'=>'default',
                'value'=>$modelPhons->default
            ],
            [
                'label'=>'mts',
                'value'=>$modelPhons->mts
            ],
            [
                'label'=>'life',
                'value'=>$modelPhons->life
            ],
            [
                'label'=>'skype',
                'value'=>$modelPhons->skype
            ],
            [
                'label'=>'viber',
                'value'=>$modelPhons->viber
            ],            [
                'label'=>'icq',
                'value'=>$modelPhons->icq
            ],
            'slug',
        ],
    ]) ?>

</div>
