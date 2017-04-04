<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ApplicationForTours */

$this->title = 'Create Application For Tours';
$this->params['breadcrumbs'][] = ['label' => 'Application For Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-for-tours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
