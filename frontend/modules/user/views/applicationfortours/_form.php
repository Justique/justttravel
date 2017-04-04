<?php

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ApplicationForTours */
/* @var $form yii\widgets\ActiveForm */

$countries = ArrayHelper::map(SiteController::getCountries(),'country_id','name');
?>

<div class="application-for-tours-form">

    <?php $form = ActiveForm::begin(); ?>
  
    <?php
        echo $form->field($model, 'country_to_id')->dropDownList($countries, [
            'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id'
        ])->label(false);
        ?>
    
    <?php echo $form->field($model, 'city_to_id')->widget(DepDrop::classname(), [
        'type' => 1,
        'options' => ['id'=>'subcat-id', 'placeholder' => 'Любой курорт',],
        'pluginOptions'=>[
            'depends'=>['cat-id'],
            'placeholder' => 'Любой курорт',
            'url' => Url::to(['/site/cities']),

        ],
        'pluginEvents' => [
            "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
        ]
    ])->label(false);
    ?>

    <?php echo $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options'=>['placeholder' => 'Дата'],
    ])->label(false) ?>

    <?= $form->field($model, 'price')->textInput(['placeholder'=>'Цена'])->label(false) ?>
    <?php echo $form->field($model, 'adults')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Взрослых'])->label(false) ?>
    <?php echo $form->field($model, 'childrens')->dropDownList(range(0,12), ['prompt' => 'Детей'])->label(false) ?>

    <?php echo $form->field($model, 'days')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Дней'])->label(false) ?>
    <?php echo $form->field($model, 'nights')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Ночей'])->label(false) ?>
    
    
    <?php
        echo $form->field($model, 'country_from_id')->dropDownList($countries, [
            'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'
        ])->label(false);
        ?>
    <?php echo $form->field($model, 'city_from_id')->widget(DepDrop::classname(), [
        'type' => 1,
        'options' => ['id'=>'subcat-id-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id-id'],
            'placeholder' => 'Из Любого города',
            'url' => Url::to(['/site/cities'])
        ],
        'pluginEvents' => [
            "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
        ]
    ])->label(false);
    ?>

    <?= $form->field($model, 'user_application_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
