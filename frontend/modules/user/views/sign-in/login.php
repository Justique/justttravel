<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password wrapper">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form password_rec_sendSMS']); ?>

            <?php echo $form->field($model, 'identity' )->textInput(['required'=>true]) ?>

            <?php echo $form->field($model, 'password')->passwordInput(['required'=>true]) ?>

            <div class="under-form" style="margin-top: 10px;">
                <?php echo l('Забыли пароль?', url('request-password-reset'), ['class'=>'forgot_pw', 'style' => 'color: #828282;']);?>
                <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
            </div>

            <div class="form-group">
                <?php echo Html::submitButton('Войти', ['class' => 'button yellow','style'=>'margin:10px 0;']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


