<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Visa */

$this->title = 'Создать визу';
$this->params['breadcrumbs'][] = ['label' => 'Visas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-create">
    <div class="head-symbol"><i class="fa fa-folder" aria-hidden="true"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
