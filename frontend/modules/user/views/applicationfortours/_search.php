<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ApplicationForToursSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="application-for-tours-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'country_to_id') ?>

    <?= $form->field($model, 'city_to_id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'adults') ?>

    <?php // echo $form->field($model, 'childrens') ?>

    <?php // echo $form->field($model, 'country_from_id') ?>

    <?php // echo $form->field($model, 'city_from_id') ?>

    <?php // echo $form->field($model, 'user_application_id') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
