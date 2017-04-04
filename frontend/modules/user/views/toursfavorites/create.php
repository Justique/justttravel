<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ToursFavorits */

$this->title = 'Create Tours Favorits';
$this->params['breadcrumbs'][] = ['label' => 'Tours Favorits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-favorits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
