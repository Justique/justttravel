<?php

use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('frontend', 'User Settings');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="head-symbol"><i class="fa fa-cog" aria-hidden="true"></i></div>
<h1><?php echo Yii::t('frontend', 'Profile settings') ?></h1>
            <?php $form = ActiveForm::begin(['id' => 'register', 'options' => [
                'class' => 'account_settings',
            ]]); ?>

                <?php echo $form->field($model, 'picture')->widget(
                    Upload::classname(),
                    [
                        'url' => ['avatar-upload']
                    ]
                ) ?>
<div class="contact_blocks">
    <?php if(userModel()->isUserTourOperator()){ ?>
        <div class="block">
            <?php echo $form->field($model, 'fullname')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваше имя'])->label(false) ?>
        </div>
        <div class="block">
            <?php echo $form->field($model, 'phone')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Тлефон'])->label(false) ?>
        </div>
        <div class="block">
            <?php echo $form->field($model, 'address')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Фактический адрес'])->label(false) ?>
        </div>
        <div class="block">
            <?php echo $form->field($model, 'ur_address')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Юридический адрес'])->label(false) ?>
        </div>
        <div class="block">
            <?php echo $form->field($model, 'company')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Имя компании'])->label(false) ?>
        </div>

                <?php } ?>
                <?php if(!userModel()->isUserTourOperator()){ ?>
                <div class="block">
                    <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваше имя'])->label(false) ?>
                </div>
                <div class="block">
            <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваше отчество'])->label(false) ?>
                </div>
                <div class="block">
            <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваша фамилия'])->label(false) ?>
                </div>
                <div class="block">
            <?php echo $form->field($model, 'byear')->dropDownList(array_combine(range(1960,2016),range(1960,2016)),['class' => 'select user-form firm-form', 'placeholder' => 'Год рожденя'])->label(false) ?>
                </div>
                <div class="block">
            <?php echo $form->field($model, 'bmonth')->dropDownList(array_combine(range(1,12),range(1,12)),['class' => 'select user-form firm-form', 'placeholder' => 'Месяц рождения'])->label(false) ?>
                </div>
                <div class="block">
            <?php echo $form->field($model, 'bday')->dropDownList(array_combine(range(1,31),range(1,31)),['class' => 'select user-form firm-form', 'placeholder' => 'День рождения'])->label(false) ?>
                </div>
                <div class="block">
            <?php echo $form->field($model, 'gender')->dropDownlist([
                \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Мужской'),
                \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Женский')
            ], ['prompt' => 'Ваш пол'])->label(false) ?>
                </div>
        <?php } ?>
        <div class="block">
                <?php
                echo $form->field($model, 'country')->dropDownList(\yii\helpers\ArrayHelper::map($countries,'country_id','name'), [
                    'prompt' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id'
                ])->label(false);
                ?>
        </div>
                <div class="block">
                <?php echo $form->field($model, 'city')->widget(DepDrop::classname(), [
                    'type' => 1,
                    'options' => ['id'=>'subcat-id'],
                    'pluginOptions'=>[
                        'depends'=>['cat-id'],
                        'placeholder' => 'Город',
                        'initialize' => true,
                        'url' => Url::to(['/site/cities'])
                    ],
                    'pluginEvents' => [
                        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
                    ]
                ])->label(false);
                ?>
            </div>
</div>
            <?php echo Html::submitButton('Сохранить измениния', ['class' => 'button yellow']) ?>
<?php ActiveForm::end(); ?>
