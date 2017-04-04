<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options'=>['class'=>'make-order-form grey-form create-req-form']]); ?>

    <p class="form-heading">Заполните поля</p>
    <div class="input-padded">
        <label>
            <p>Имя и фамилия</p>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(false) ?>
        </label>
    </div>
    <div class="input-padded">
    <label>
        <p>Email</p>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
    </label>
    </div>
    <div class="input-padded">
    <label>
        <p>Пароль</p>
        <?= $form->field($model, 'password_hash')->passwordInput(['value'=>""])->label(false)?>
    </label>
    </div>
    <div class="cols-inline">
        <label>
            <p>МТС</p>
            <?= $form->field($modelManagerPhone, 'mts')->textInput()->label(false) ?>
        </label>
        <label>
            <p>Life</p>
            <?= $form->field($modelManagerPhone, 'life')->textInput()->label(false) ?>
        </label>
        <label>
            <p>Городской</p>
            <?= $form->field($modelManagerPhone, 'default')->textInput()->label(false) ?>
        </label>
        <label>
            <p>Viber</p>
            <?= $form->field($modelManagerPhone, 'viber')->textInput()->label(false) ?>
        </label>
        <label>
            <p>skype</p>
            <?= $form->field($modelManagerPhone, 'skype')->textInput()->label(false) ?>
        </label>
        <label>
            <p>ICQ</p>
            <?= $form->field($modelManagerPhone, 'icq')->textInput()->label(false) ?>
        </label>
    </div>

<?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false); ?>
<?= $form->field($model, 'type')->hiddenInput(['value'=>3])->label(false); ?>
<!--    <div class="centered img-capture">-->
<!--        <div class="container">-->
<!--            <div class="canvas-holder">-->
<!--                <canvas></canvas>-->
<!--            </div>-->
<!--            <div>-->
<!--                <a href="#" class="button">удалить аватар</a>-->
<!--                <input type="file" accept="/image" hidden>-->
<!--                <a href="#" class="button">загрузить аватар</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'submit' : 'submit']) ?>
<!--    <a href="#" class="button-delete"><i class="fa fa-trash" aria-hidden="true"></i></a>-->
<?php ActiveForm::end(); ?>
