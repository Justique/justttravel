<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form password_rec_sendSMS']); ?>
<?php echo $form->field($model, 'identity' )->textInput(['required'=>true]) ?>
<?php echo $form->field($model, 'password')->passwordInput(['required'=>true]) ?>
<div class="under-form">
    <?php echo l('Забыли пароль?', url('request-password-reset'),['class'=>'forgot_pw']);?>
    <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
</div>
<input type="submit" value="ВОЙТИ">
<?php ActiveForm::end(); ?>


