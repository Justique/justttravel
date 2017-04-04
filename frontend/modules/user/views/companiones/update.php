<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Companiones */

$this->title = 'Update Companiones: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Companiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="companiones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'myCompaniones' => $myCompaniones,
    ]) ?>

</div>
