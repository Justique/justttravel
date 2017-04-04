<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tours */

$this->title = 'Добавить тур';
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="head-symbol"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>

<h1><?= Html::encode($this->title) ?></h1>

<div class="tours-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
