<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Создать Менеджера';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="head-symbol"><i class="fa fa-smile-o"></i></div>
<h1><?= Html::encode($this->title) ?></h1>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
        'modelManagerPhone' => $modelManagerPhone,
    ]) ?>

</div>
