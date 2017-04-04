<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\UserApplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'city_id') ?>

    <?= $form->field($model, 'resort_city') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'adults') ?>

    <?php // echo $form->field($model, 'childrens') ?>

    <?php // echo $form->field($model, 'country_from_id') ?>

    <?php // echo $form->field($model, 'shopping_city') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
