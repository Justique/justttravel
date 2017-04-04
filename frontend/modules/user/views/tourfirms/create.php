<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tourfirms */

$this->title = 'Турфирма';
$this->params['breadcrumbs'][] = ['label' => 'Tourfirms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tourfirms-create">
    <div class="head-symbol"><i class="fa fa-diamond" aria-hidden="true"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPhons' => $modelPhons,
        'modelWorkTime' => $modelWorkTime,

    ]) ?>

</div>
