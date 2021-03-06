<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\ResetPasswordForm */

$this->title = Yii::t('frontend', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password wrapper">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?php echo $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?php echo Html::submitButton('Save', ['class' => 'button yellow','style'=>'margin:10px 0;']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
