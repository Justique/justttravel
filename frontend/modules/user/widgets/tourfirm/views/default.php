<?php
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */
?>
<div class="tourfirms-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelPhons, 'default')->textInput() ?>
    <?= $form->field($modelPhons, 'mts')->textInput() ?>
    <?= $form->field($modelPhons, 'life')->textInput() ?>
    <?= $form->field($modelPhons, 'viber')->textInput() ?>
    <?= $form->field($modelPhons, 'skype')->textInput() ?>
    <?= $form->field($modelPhons, 'icq')->textInput() ?>
    <?= $form->field($model, 'address')->textInput(['class'=>'form-control', 'id'=>'us3-address']) ?>

    <?= $form->field($model, 'radius')->textInput(['class'=>'form-control', 'id'=>'us3-radius'])->label() ?>
            <div id="us3" style="width: auto; height: 400px;"></div>
            <div class="clearfix">&nbsp;</div>
            <div class="m-t-small">
                <?= $form->field($model, 'latitude')->hiddenInput(['class'=>'form-control', 'id'=>'us3-lat'])->label(false) ?>
                <?= $form->field($model, 'longitude')->hiddenInput(['class'=>'form-control', 'id'=>'us3-lon'])->label(false) ?>
            </div>
            <div class="clearfix"></div>
            <script>$('#us3').locationpicker({
            <?php if($model->latitude && $model->longitude){ ?>
                    location: {latitude: <?php echo $model->latitude ?>, longitude: <?php echo $model->longitude ?>},
            <?php  }else{ ?>
                    location: {latitude: 53.9045, longitude: 27.5615},
            <?php } ?>
                        radius: <?php echo (!empty($model->radius) ? $model->radius : 50); ?>,
                        inputBinding: {
                            latitudeInput: $('#us3-lat'),
                            longitudeInput: $('#us3-lon'),
                            radiusInput: $('#us3-radius'),
                            locationNameInput: $('#us3-address')
                        },
                        enableAutocomplete: true,
                        onchanged: function (currentLocation, radius, isMarkerDropped) {
                            // Uncomment line below to show alert on each Location Changed event
                            //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                        }
                        });
                    </script>
        <?= $form->field($model, 'legal_info')->textInput() ?>

        <?php echo $form->field($model, 'attachments')->widget(
            Upload::className(),
            [
                'url' => ['/file-storage/upload'],
                'sortable' => true,
                'maxFileSize' => 10000000, // 10 MiB
                'maxNumberOfFiles' => 10
            ]);
        ?>

        <?= $form->field($modelWorkTime, 'monday')->textInput()?>
        <?= $form->field($modelWorkTime, 'tuesday')->textInput()?>
        <?= $form->field($modelWorkTime, 'wednesday')->textInput()?>
        <?= $form->field($modelWorkTime, 'thursday')->textInput()?>
        <?= $form->field($modelWorkTime, 'friday')->textInput()?>
        <?= $form->field($modelWorkTime, 'saturday')->textInput()?>
        <?= $form->field($modelWorkTime, 'sunday')->textInput()?>

        <?= $form->field($model, 'touroperator_id')->hiddenInput(['value' => user()->id])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Изменить', ['class' => 'button yellow']) ?>
            <?= Html::a("<i class='fa fa-trash'></i>". 'Удалить', ["/user/tourfirms/delete?id=$model->id"],['class' => 'ajax-link button yellow trash','title'=>'удалить', "aria-label"=>'Удалить', 'data-confirm'=>'Вы уверены, что хотите удалить турфирму?','data-method'=>'post', 'data-pjax'=>0]) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

