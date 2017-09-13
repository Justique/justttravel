<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name . '- Контакты';
?>
<section class="company-page with-rating">
    <div class="content-wrapper">
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmHeaderWidget::widget(['model' => $model]) ?>
        <div class="contacts-container">
            <?php if ($model->tourfirmsPhon): ?>
                <h1>Телефоны</h1>
                <ul class="manager-contact">
                    <?php if ($model->tourfirmsPhon->default) { ?>
                        <li class="contact-phone"><?php echo $model->tourfirmsPhon->default ?></li><?php } ?>
                    <?php if ($model->tourfirmsPhon->life) { ?>
                        <li class="contact-life"><?php echo $model->tourfirmsPhon->life ?></li><?php } ?>
                    <?php if ($model->tourfirmsPhon->mts) { ?>
                        <li class="contact-mts"><?php echo $model->tourfirmsPhon->mts ?></li><?php } ?>
                    <?php if ($model->tourfirmsPhon->velcom) { ?>
                        <li class="contact-viber"><?php echo $model->tourfirmsPhon->velcom ?></li><?php } ?>
                    <?php if ($model->tourfirmsPhon->skype) { ?>
                        <li class="contact-skype"><?php echo $model->tourfirmsPhon->skype ?></li><?php } ?>
                    <?php if ($model->tourfirmsPhon->icq) { ?>
                        <li class="contact-icq"><?php echo $model->tourfirmsPhon->icq ?></li><?php } ?>
                </ul>
            <?php endif; ?>
            <h1>Обратная связь</h1>
            <?php $form = ActiveForm::begin(
                [
                    'action' => '/tourfirms/feedback',
                    'options' => [
                        'class' => 'feedback-form ajax-form',
                        'enctype' => 'multipart/form-data'
                    ]
                ]);
            ?>
            <?php $mdoelFeed = new \common\models\CustomerFeedback(); ?>
            <?= $form->field($mdoelFeed, 'name')->textInput(['value' => '', 'placeholder' => "Ваше имя"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'email')->textInput(['value' => '', 'placeholder' => "Ваш email"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'phone')->textInput(['value' => '', 'placeholder' => "Ваш телефон"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'question')->textarea(['rows' => 6, 'value' => '', 'placeholder' => "Ваш вопрос"])->label(false) ?>
            <?= $form->field($mdoelFeed, 'tourfirm_id')->hiddenInput(['value' => $model->id])->label(false) ?>
            <?= $form->field($mdoelFeed, 'user_id')->hiddenInput(['value' => user()->id])->label(false) ?>
            <?= $form->field($mdoelFeed, 'date_create')->hiddenInput(['value' => time()])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'batton yellow']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <h1>Адрес</h1>

            <div class="contact-map">
                <p id="address-contact">
                    <i class="fa fa-map-marker"></i>
                    <a href="#address-contact"><?php echo $model->address ?></a>
                </p>
            </div>
        </div>
    </div>
    <?php if ($model->longitude && $model->latitude) { ?>
        <?php
        echo \pigolab\locationpicker\LocationPickerWidget::widget([
            'key' => 'AIzaSyAPB4WlsQGENW4ppqlmHezDJsIUOg31Asg', // optional , Your can also put your google map api key
            'options' => [
                'style' => 'width: 100%; height: 400px', // map canvas width and height
            ] ,
            'clientOptions' => [
                'location' => [
                    'latitude'  => $model->latitude,
                    'longitude' => $model->longitude,
                ],
                'radius'    => $model->radius,
            ]
        ]);
        ?>
    <?php } else { ?>
        <h3 class="is-empty-map">Администратор турфирмы еще не ввел данные карты.</h3>
    <?php } ?>
</section>