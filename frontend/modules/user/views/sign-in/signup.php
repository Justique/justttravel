<?php
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\base\MultiModel */
/* @var $tariffs array */

$this->title = Yii::t('frontend', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="register-page">
    <div class="content-wrapper">
        <h1>Регистрация</h1>
        <?php $form = ActiveForm::begin(['id' => 'register', 'options' => [
            'class' => 'user-form',
        ]]); ?>
        <div class="button-line" id="reg-block">
            <input type="radio" <?= !$model->getModel('profile')->tariff ? 'checked' : '' ?> name="SignupForm[type]" value="1" id="tourist"/>
            <label for="tourist">Турист</label>
            <input type="radio" <?= $model->getModel('profile')->tariff ? 'checked' : '' ?> name="SignupForm[type]" value="2" id="tourfirm"/>
            <label for="tourfirm">Турфирма</label>
        </div>
        <div class="container">

            <?php echo $form->field($model->getModel('signup'), 'username')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Логин', 'required'=>true])->label(false) ?>
            <?php echo $form->field($model->getModel('signup'), 'password')->passwordInput(['class' => 'user-form firm-form', 'placeholder' => 'Пароль', 'required'=>true])->label(false) ?>
            <div id="complexity" class="default weak strong">Average!</div>
            <?php echo $form->field($model->getModel('signup'), 'email')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Ваш e-mail', 'required'=>true])->label(false) ?>

            <div class="row firm-form">
                <?php echo $form->field($model->getModel('profile'), 'fullname')->textInput(['class' => '', 'placeholder' => 'Ваше Ф.И.О.'])->label(false) ?>
            </div>
            <div class="row user-form">
                <?php echo $form->field($model->getModel('profile'), 'lastname')->textInput(['class' => '', 'placeholder' => 'Ваш фамилия'])->label(false) ?>
            </div>
            <div class="row user-form">
                <?php echo $form->field($model->getModel('profile'), 'firstname')->textInput(['class' => '', 'placeholder' => 'Вашe имя'])->label(false) ?>
            </div>
            <div class="row user-form">
                <?php echo $form->field($model->getModel('profile'), 'middlename')->textInput(['class' => '', 'placeholder' => 'Ваше Отчество'])->label(false) ?>
            </div>
            <div class="row firm-form">
                <?php echo $form->field($model->getModel('profile'), 'phone')->textInput(['class' => '', 'placeholder' => 'Телефон'])->label(false) ?>
            </div>
            <div class="row firm-form">
                <?php echo $form->field($model->getModel('profile'), 'address')->textInput(['class' => '', 'placeholder' => 'Фактический адрес'])->label(false) ?>
            </div>
            <div class="row firm-form">
                <?php echo $form->field($model->getModel('profile'), 'ur_address')->textInput(['class' => '', 'placeholder' => 'Юридический адрес'])->label(false) ?>
            </div>
            <div class="row firm-form">
                <?php echo $form->field($model->getModel('profile'), 'company')->textInput(['class' => '', 'placeholder' => 'Название компании'])->label(false) ?>
            </div>
            <div class="row firm-form">
                <?php echo $form->field($model->getModel('profile'), 'tariff')->dropDownList($tariffs, ['class' => 'select user-form', 'prompt' => 'Тариф'])->label(false) ?>
            </div>
            <div class="row user-form">
                <?php echo $form->field($model->getModel('profile'), 'gender')->dropDownList(
                    [
                        \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Мужской'),
                        \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Женский')
                    ],
                    ['class' => 'select user-form', 'prompt' => 'Ваш пол'])->label(false) ?>
            </div>
            <div class="row user-form">
                 <?php echo $form->field($model->getModel('profile'), 'byear')->dropDownList(array_combine(range(1960,2016),range(1960,2016)),['class' => 'row select user-form firm-form ', 'prompt' => 'Год рождения'])->label(false) ?>
            </div>
            <div class="row user-form">
                <?php echo $form->field($model->getModel('profile'), 'bmonth')->dropDownList(array_combine(range(1,12),range(1,12)),['class' => 'select user-form ', 'prompt' => 'Месяц'])->label(false) ?>
            </div>
            <div class="row user-form">
                <?php echo $form->field($model->getModel('profile'), 'bday')->dropDownList(array_combine(range(1,31),range(1,31)),['class' => 'select user-form ', 'prompt' => 'День'])->label(false) ?>
            </div>
            
            <?php
                echo $form->field($model->getModel('profile'), 'country')->dropDownList(\yii\helpers\ArrayHelper::map(\frontend\controllers\SiteController::getCountries(),'country_id','name'), [
                    'prompt' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id'
                ])->label(false);
                ?>

            <?php echo $form->field($model->getModel('profile'), 'city')->widget(DepDrop::classname(), [
                'type' => 1,
                'options' => ['id'=>'subcat-id'],
                'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder' => 'Город',
                    'url' => Url::to(['/site/cities'])
                ],
                'pluginEvents' => [
                    "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
                ]
                ])->label(false);
            ?>
        </div>
        <input type="checkbox" id="terms">
        <label for="terms">Я принимаю <a href="#">условия пользовательского соглашения</a> и ознакомлен с <a href="#">политикой конфиденциальности</a>.</label>
        <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>

