<?php

use common\models\Tourfirms;
use common\models\Transports;
use common\models\User;
use frontend\controllers\SiteController;
use frontend\modules\user\models\LoginForm;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\ActiveForm;

$countries = ArrayHelper::map(SiteController::getCountries(),'country_id','name');

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */
?>
<?php if($flag){
    $action = '/user/applicationfortours/update?id='.$model->id;
} else {
    $action = '/user/applicationfortours/create';
}
?>
<?php $form = ActiveForm::begin(['options'=>['class'=>'ajax-form make-order-form'], 'action'=>$action]); ?>
<h2>Ваше предложение</h2>
<?php if(userModel()->isUserTourOperator()) { ?>
    <?php echo $form->field($model, 'manager_id')->dropDownList(User::getManagersOfCompany(), ['prompt' => 'Менеджер'])->label(false) ?>
<?php }else{ ?>
    <?= $form->field($model, 'manager_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
<?php }?>
<?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>Tourfirms::getTourfirmId(user()->id)])->label(false) ?>
<?php
$transports = Transports::find()->all();
$items = ArrayHelper::map($transports,'id','type');
?>
<?php echo $form->field($model, 'transport_type')->dropDownList($items, ['prompt' => 'Вид транспорта'])->label(false) ?>

<?php
    echo $form->field($model, 'country_to_id')->dropDownList($countries, [
        'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id'.$id_application
    ])->label(false);
?>

<?php echo $form->field($model, 'city_to_id')->widget(DepDrop::classname(), [
    'type' => 1,
    'options' => ['id'=>'subcat-id'.$id_application],
    'pluginOptions'=>[
        'depends'=>['cat-id'.$id_application],
        'placeholder' => 'Любой курорт',
        'url' => Url::to(['/site/cities'])
    ],
        'pluginEvents' => [
            "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
        ]
])->label(false);
?>
<?php echo $form->field($model, 'date')->widget(DatePicker::classname(), [
    'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>[
        'placeholder' => 'Дата',
        'id'=> 'applicationfortours-date'.$id_application
    ],
])->label(false) ?>
<?= $form->field($model, 'price')->textInput(['placeholder'=>'Цена'])->label(false) ?>

<?php echo $form->field($model, 'adults')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Взрослых'])->label(false) ?>
<?php echo $form->field($model, 'childrens')->dropDownList(range(0,12), ['prompt' => 'Детей'])->label(false) ?>

<?php echo $form->field($model, 'days')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Дней'])->label(false) ?>
<?php echo $form->field($model, 'nights')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Ночей'])->label(false) ?>
<?php
    echo $form->field($model, 'country_from_id')->dropDownList($countries, [
        'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'.$id_application
    ])->label(false);
    ?>
<?php echo $form->field($model, 'city_from_id')->widget(DepDrop::classname(), [
    'type' => 1,
    'options' => ['id'=>'subcat-id-id'.$id_application],
    'pluginOptions'=>[
        'depends'=>['cat-id-id'.$id_application],
        'placeholder' => 'Из Любого города',
        'url' => Url::to(['/site/cities'])
    ],
        'pluginEvents' => [
            "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
        ]
])->label(false);
?>

<?= $form->field($model, 'user_application_id')->hiddenInput(['value'=>$id_application])->label(false) ?>

    <?= Html::submitButton($model->isNewRecord ? 'Отправить' : 'Обновить', ['class' => 'submit']) ?>
<?php ActiveForm::end(); ?>

