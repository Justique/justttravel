<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Companiones */

$this->title = 'Создайте заявку';
$this->params['breadcrumbs'][] = ['label' => 'Companiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companiones-create">
    <div class="head-symbol"><i class="fa fa-smile-o"></i></div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'myCompaniones' => $myCompaniones,
    ]) ?>

</div>
