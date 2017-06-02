<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Tourfirms */
/* @var $tariffs array */

$this->title = 'Турфирма: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Tourfirms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="tourfirms-update">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'legal_info') ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= $form->field($model->touroperator->tariff, 'tariff_id')->dropDownList($tariffs) ?>
        <?= $form->field($model->touroperator->tariff, 'valid_at')->widget(DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'value' => date('Y-m-d'),
            'options'=>[
                'class' => 'form-control'
            ],
            'clientOptions' => [
                'minDate' => 0,
            ],
        ]) ?>
        <div class="form-group">
            <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
