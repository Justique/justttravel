<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ToursOrder */

$this->title = 'Create Tours Order';
$this->params['breadcrumbs'][] = ['label' => 'Tours Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
