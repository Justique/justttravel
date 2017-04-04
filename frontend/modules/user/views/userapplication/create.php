<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserApplication */

$this->title = 'Создать заявку';
$this->params['breadcrumbs'][] = ['label' => 'User Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-application-create">
    <div class="head-symbol"><i class="fa fa-commenting"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
