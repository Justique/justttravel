<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VisaOrder */

$this->title = 'Create Visa Order';
$this->params['breadcrumbs'][] = ['label' => 'Visa Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
