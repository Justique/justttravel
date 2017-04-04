<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */
?>

<?php $form = ActiveForm::begin(['id' => 'login-form password_rec_sendSMS']); ?>
<?php echo $form->field($model, 'identity' )->textInput(['required'=>true]) ?>
<?php echo $form->field($model, 'password')->passwordInput(['required'=>true]) ?>
    <div class="under-form">
        <?php echo l('Забыли пароль?', url('request-password-reset'),['class'=>'forgot_pw']);?>
        <?php echo $form->field($model, 'rememberMe')->checkbox()->label('<i class="fa fa-check-square"></i>') ?>
    </div>
    <input type="submit" value="ВОЙТИ">
    <div style="text-align: right; padding-top: 10px;">
    <?php echo l('Регистрация', \frontend\modules\user\Module::SignUpUrl(),['style'=>'color:#949494;font-size:14px;']) ?>
    </div>
<?php ActiveForm::end(); ?>

