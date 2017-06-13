<?php

use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Tourfirms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tourfirms-form">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'company_settings']]); ?>
    <div class="contact_blocks">
        <div class="block">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="block">
            <?= $form->field($modelPhons, 'default')->textInput() ?>
        </div>

        <div class="block">
            <?= $form->field($modelPhons, 'mts')->textInput() ?>
        </div>

        <div class="block">
            <?= $form->field($modelPhons, 'life')->textInput() ?>
        </div>

        <div class="block">
            <?= $form->field($modelPhons, 'velcom')->textInput() ?>
        </div>

        <div class="block">
            <?= $form->field($modelPhons, 'skype')->textInput() ?>
        </div>

        <div class="block">
            <?= $form->field($modelPhons, 'icq')->textInput() ?>
        </div>
    </div>
        <div class="row_blocks">
        <div class="block">
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>

        <div class="block">
            <?= $form->field($model, 'legal_info')->textarea() ?>
        </div>
        <p class="section_header">режим работы</p>
        <div class="row_blocks company_schedule">
            <div class="block">
                <?= $form->field($modelWorkTime, 'monday')->textInput()?>
            </div>

            <div class="block">
                <?= $form->field($modelWorkTime, 'tuesday')->textInput()?>
            </div>

            <div class="block">
                <?= $form->field($modelWorkTime, 'wednesday')->textInput()?>
            </div>

            <div class="block">
                <?= $form->field($modelWorkTime, 'thursday')->textInput()?>
            </div>

            <div class="block">
                <?= $form->field($modelWorkTime, 'friday')->textInput()?>
            </div>

            <div class="block">
                <?= $form->field($modelWorkTime, 'saturday')->textInput()?>
            </div>

            <div class="block">
                <?= $form->field($modelWorkTime, 'sunday')->textInput()?>
            </div>
        </div>
        <div class="block">
            <?php echo $form->field($model, 'attachments')->widget(
                Upload::className(),
                [
                    'url' => ['/file-storage/upload'],
                    'sortable' => true,
                    'maxFileSize' => 10000000, // 10 MiB
                    'maxNumberOfFiles' => 10,
                    'acceptFileTypes' => new JsExpression('/(\.|\/)(jpe?g)$/i')
                ]);
            ?>
        </div>
        <div class="block">
            <div class="contact-map">
                <div class="form-horizontal" style="width: 550px">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                            <?= $form->field($model, 'address')->textInput(['class'=>'form-control', 'id'=>'us3-address', 'readonly' => true])->label('АДРЕС (установите маркер на карте)') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>

                        <div class="col-sm-5">
                            <?= $form->field($model, 'radius')->textInput(['class'=>'form-control', 'id'=>'us3-radius'])?>
                        </div>
                    </div>
                    <div id="us3" style="width: 550px; height: 400px; margin-top: 10px;">
                        <?php
                        echo \pigolab\locationpicker\LocationPickerWidget::widget([
                            'key' => 'AIzaSyAPB4WlsQGENW4ppqlmHezDJsIUOg31Asg', // optional , Your can also put your google map api key
                            'options' => [
                                'style' => 'width: 100%; height: 400px', // map canvas width and height
                            ] ,
                            'clientOptions' => [
                                'location' => [
                                    'latitude'  => $model->latitude ? $model->latitude : 53.9045,
                                    'longitude' => $model->longitude ? $model->longitude : 27.5615,
                                ],
                                'radius'    => $model->radius ? $model->radius : 50,
                                'inputBinding' => [
                                    'latitudeInput'     => new JsExpression("$('#us3-lat')"),
                                    'longitudeInput'    => new JsExpression("$('#us3-lon')"),
                                    'radiusInput'       => new JsExpression("$('#us3-radius')"),
                                    'locationNameInput' => new JsExpression("$('#us3-address')")
                                ]
                            ]
                        ]);
                        ?>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="m-t-small">
                        <?= $form->field($model, 'latitude')->hiddenInput(['class'=>'form-control', 'id'=>'us3-lat'])->label(false) ?>
                        <?= $form->field($model, 'longitude')->hiddenInput(['class'=>'form-control', 'id'=>'us3-lon'])->label(false) ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</div>

    <?= $form->field($model, 'touroperator_id')->hiddenInput(['value' => user()->id])->label(false) ?>
    <?php if(isset($model->id)){ ?>
        <div class="buttons">
            <?= Html::submitButton('Сохранить Изменение', ['class' => 'button yellow']) ?>
            <?= Html::a("<i class='fa fa-trash' aria-hidden='true'></i>". 'Удалить Турфирму', ["/user/tourfirms/delete?id=$model->id"],['class' => 'ajax-link button yellow','title'=>'удалить','style'=>'display:inline-block', "aria-label"=>'Удалить', 'data-confirm'=>'Вы уверены, что хотите удалить турфирму?','data-method'=>'post', 'data-pjax'=>0]) ?>
        </div>
    <?php }else{ ?>
        <div class="buttons">
            <?= Html::submitButton('Создать', ['class' => 'button yellow']) ?>
        </div>
    <?php } ?>
    <?php ActiveForm::end(); ?>

</div>
