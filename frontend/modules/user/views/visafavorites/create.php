<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VisaFavorites */

$this->title = 'Create Visa Favorites';
$this->params['breadcrumbs'][] = ['label' => 'Visa Favorites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-favorites-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
