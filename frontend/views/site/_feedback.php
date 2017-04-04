<?php

use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<div class="ttl">Justtravel.by работает в beta-версии!</div>
<p>Мы не можем гарантировать бесперебойную работу сайта, а так же то, что Вы не увидите корявые коды  и 
    ошибки различного рода. Если Вы заметили на сайте ошибки любого рода - сообщите нам об этом, 
    и мы устраним её в кратчайшие сроки!</p>

<?php Pjax::begin([
    'id' => 'feedback-form-pjax-container',
    'enablePushState' => false,
    'enableReplaceState' => false,
    'formSelector' => '#feedback-form'
]);?>
    <div class="beta__popup-form">
        <?php $form = ActiveForm::begin([
            'id' => 'feedback-form',
            'action' => ['/site/feedback'],
            'encodeErrorSummary' => false,
            'enableClientValidation' => false,
            'enableAjaxValidation' => true,
            'validateOnChange' => false,
        ]); ?>
            <fieldset>
                <?= $form->field($model, 'body')->textArea(['rows' => 1, 'cols' => 1, 'class' => 'txt-input', 'placeholder' => 'Ваше сообщение...']) ?>
                <div class="row">
                    <div class="col">
                        <?= $form->field($model, 'name')->textInput(['class' => 'txt-input', 'placeholder' => 'Ваше имя'])->label(false) ?>
                    </div>
                    <div class="col">
                        <?= $form->field($model, 'email')->textInput(['class' => 'txt-input', 'placeholder' => 'Ваш e-mail'])->label(false) ?>
                    </div>
                </div>
                <input type="submit" value="ОТПРАВИТЬ" class="button yellow">
            </fieldset>
        <?php ActiveForm::end(); ?>
    </div>
    <p>Мы - разработчики сайта, благодарим Вас за то, что тестируете сайт вместе с нами!</p>

<?php Pjax::end();?>