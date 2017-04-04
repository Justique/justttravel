<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings')
?>
<div class="head-symbol"><i class="fa fa-commenting"></i></div>
<h1><?php echo Yii::t('frontend', 'Profile settings') ?></h1>
<?php if (!userModel()->isUserTourOperator()) { ?>
    <ul>
        <li><a href="#">Личные данные</a></li>
        <li><a href="#">Данные акаунта</a></li>
        <li><a href="#">Попутчики</a></li>
        <li><a href="#">Избранное</a></li>
        <li><a href="#">В сравнени</a></li>
    </ul>
<?php } else { ?>
    <ul>
        <li><a href="#">Данные компании</a></li>
        <li><a href="#">Данные акаунта</a></li>
        <li><a href="#">Туры компании</a></li>
        <li><a href="#">Менеджеры компании</a></li>
        <li><a href="#">Новости\Акции</a></li>
        <li><a href="#">Контактные данные</a></li>
    </ul>
<?php } ?>
<section class="register-page">
    <div class="content-wrapper">
        <div class="container">

            <?php $form = ActiveForm::begin(['id' => 'register', 'options' => [
                'class' => 'user-form',
            ]]); ?>
            <div class="test" style="
    width: 30%;
    margin: 0 auto;
">
                <h2><?php echo Yii::t('frontend', 'Profile settings') ?></h2>

                <?php echo $form->field($model->getModel('profile'), 'picture')->widget(
                    Upload::classname(),
                    [
                        'url' => ['avatar-upload']
                    ]
                ) ?>
                <?php echo $form->field($model->getModel('profile'), 'firstname')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваше имя'])->label(false) ?>

                <?php echo $form->field($model->getModel('profile'), 'middlename')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваша фамилия'])->label(false) ?>

                <?php echo $form->field($model->getModel('profile'), 'lastname')->textInput(['maxlength' => 255, 'class' => 'user-form', 'placeholder' => 'Ваше отчество'])->label(false) ?>

                <?php echo $form->field($model->getModel('profile'), 'gender')->dropDownlist([
                    \common\models\UserProfile::GENDER_FEMALE => Yii::t('frontend', 'Мужской'),
                    \common\models\UserProfile::GENDER_MALE => Yii::t('frontend', 'Женский')
                ], ['prompt' => 'Ваш пол'])->label(false) ?>

                <h2><?php echo Yii::t('frontend', 'Account Settings') ?></h2>

                <?php echo $form->field($model->getModel('account'), 'username')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Логин'])->label(false) ?>

                <?php echo $form->field($model->getModel('account'), 'email')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Ваш e-mail'])->label(false) ?>

                <?php echo $form->field($model->getModel('account'), 'password')->passwordInput(['class' => 'user-form firm-form', 'placeholder' => 'Пароль'])->label(false) ?>

                <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput(['class' => 'user-form firm-form', 'placeholder' => 'Повторите пароль'])->label(false) ?>

                <div class="form-group">
                    <?php echo Html::submitButton(Yii::t('frontend', 'Update'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>