<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TourfirmsReviews */

$this->title = 'Create Tourfirms Reviews';
$this->params['breadcrumbs'][] = ['label' => 'Tourfirms Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tourfirms-reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
