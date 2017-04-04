<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VisaFavorites */

$this->title = 'Update Visa Favorites: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visa Favorites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visa-favorites-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
