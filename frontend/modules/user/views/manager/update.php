<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Изменть менеджера: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="head-symbol"><i class="fa fa-smile-o"></i></div>
<h1><?= Html::encode($this->title) ?></h1>
<div class="user-update">


    <?= $this->render('_form', [
        'model' => $model,
        'modelManagerPhone' => $modelManagerPhone,
    ]) ?>

</div>
