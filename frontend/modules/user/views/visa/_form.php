<?php

use common\models\Tourfirms;
use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$countries = ArrayHelper::map(frontend\controllers\SiteController::getCountries(),'country_id','name');

/* @var $this yii\web\View */
/* @var $model common\models\Visa */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options'=>['class'=>'make-order-form grey-form']]); ?>
<?php if(userModel()->isUserTourOperator()) { ?>
    <div class="input-padded">
        <p>Менеджер</p>
        <label class="select halved">
            <?php echo $form->field($model, 'manager_id')->dropDownList(User::getManagersOfCompany(), ['prompt' => 'Менеджер'])->label(false) ?>
        </label>
    </div>
<?php }else{ ?>
    <?= $form->field($model, 'manager_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
<?php }?>

    <div class="input-padded">
        <p>Страна</p>
        <label class="select halved">
             <?php
                echo $form->field($model, 'country_id')->dropDownList($countries, [
                    'prompt' => 'Страна вылета','class' => 'select user-form firm-form', 'id'=>'cat-id-id'
                ])->label(false);
                ?>
       
        </label>
    </div>
<div class="input-padded">
    <p>Город</p>
    <label class="select halved">
    <?php echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
        'type' => 1,
        'options' => ['id'=>'subcat-id-id'],
        'pluginOptions'=>[
            'depends'=>['cat-id-id'],
            'placeholder' => 'Город',
            'url' => Url::to(['/site/cities'])
        ],
        'pluginEvents' => [
            "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
        ]
    ])->label(false);
    ?>
    </label>
</div>
<div class="input-padded">
    <p>Название визы:</p>
    <label class="halved">
        <?= $form->field($model, 'name')->textInput()->label(false) ?>
    </label>
</div>

    <div class="input-padded">
        <p>Вид визы:</p>
        <label class="halved">
            <?= $form->field($model, 'type')->textInput()->label(false) ?>
        </label>
    </div>
    <div class="input-padded">
        <p>Период действия:</p>
        <label class="halved">
            <?= $form->field($model, 'type_time')->textInput()->label(false) ?>
        </label>
    </div>
    <div class="input-padded">
        <p>Срок оформления:</p>
        <label class="halved">
            <?= $form->field($model, 'registration_period')->textInput()->label(false) ?>
        </label>
    </div>
    <div class="input-padded">
        <p>Документы:</p>
        <label>
            <?= $form->field($model, 'documents')->textarea(['maxlength' => true])->label(false) ?>
        </label>
    </div>
    <div class="input-padded">
        <p>ЦЕНА:</p>
        <label class="halved">
            <?= $form->field($model, 'price')->textInput()->label(false) ?>
        </label>
    </div>
    <div class="input-padded">
        <p>ОПИСАНИЕ:</p>
        <label>
            <?php echo $form->field($model, 'description')->widget(
                \yii\imperavi\Widget::className(),
                [
                    'plugins' => ['fullscreen', 'fontcolor', 'video'],
                    'options' => [
                        'minHeight' => 400,
                        'maxHeight' => 400,
                        'buttonSource' => true,
                        'convertDivs' => false,
                        'removeEmptyTags' => false,
                        'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
                    ]
                ]
            )->label(false) ?>
        </label>
    </div>
<?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>Tourfirms::getTourfirmId(user()->id)])->label(false)  ?>
<?= $form->field($model, 'tour_id')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'date_create')->hiddenInput(['value'=>time()])->label(false)  ?>
<?= $form->field($model, 'date_update')->hiddenInput(['value'=>time()])->label(false)  ?>

<?= Html::submitButton('Добавить', ['class' => 'submit']) ?>
<?php ActiveForm::end(); ?>
