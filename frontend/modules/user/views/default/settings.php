<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'User Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="head-symbol"><i class="fa fa-cog" aria-hidden="true"></i></div>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(['id' => 'register', 'options' => [
    'class' => 'account_settings',
]]); ?>
    <div class="contact_blocks">
        <div class="block">
            <?php echo $form->field($model->getModel('account'), 'username')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Логин']) ?>
        </div>
        <div class="block">
            <?php echo $form->field($model->getModel('account'), 'email')->textInput(['class' => 'user-form firm-form', 'placeholder' => 'Ваш e-mail']) ?>
        </div>
        <div class="block">
            <?php echo $form->field($model->getModel('account'), 'password')->passwordInput(['class' => 'user-form firm-form']) ?>
        </div>
        <div class="block">
            <?php echo $form->field($model->getModel('account'), 'password_confirm')->passwordInput(['class' => 'user-form firm-form']) ?>
        </div>
    </div>

    <?php echo Html::submitButton('Сохранить изменения', ['class' => 'button yellow']) ?>
<?php ActiveForm::end(); ?>
