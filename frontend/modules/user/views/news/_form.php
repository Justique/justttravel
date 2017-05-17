<?php

use common\models\Tourfirms;
use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options'=>['class'=>'make-order-form grey-form create-req-form']]); ?>

    <p class="form-heading">Заполните поля</p>
    <?php echo \frontend\modules\user\widgets\status\Status::widget(['model'=>$model, 'name'=>'Article[status]', 'field'=>'status', 'title'=>'новость']) ?>

    <div class="input-padded">
        <label>
            <p>Введите заголовок</p>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder'=>'Заголовок'])->label(false) ?>
        </label>
    </div>
    <div class="input-padded">
        <p>Категория</p>
        <label class="select halved">
            <?php echo $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                $categories,
                'id',
                'title'
            ), ['prompt'=>'Категория'])->label(false) ?>
        </label>
    </div>
    <div class="input-padded text-editor">
        <p>ОПИСАНИЕ:</p>
        <label>
            <?php echo $form->field($model, 'body')->widget(
                \yii\imperavi\Widget::className(),
                [
                    'plugins' => ['fullscreen', 'fontcolor', 'video'],
                    'options' => [
                        'minHeight' => 400,
                        'maxHeight' => 400,
                        'buttonSource' => true,
                        'convertDivs' => false,
                        'removeEmptyTags' => false,
                        'imageUpload' => Yii::$app->urlManager->createUrl(['/file-storage/upload-imperavi'])
                    ]
                ]
            )->label(false) ?>
        </label>
        <?php echo $form->field($model, 'thumbnail')->widget(
            Upload::className(),
            [
                'url' => ['/file-storage/upload'],
                'maxFileSize' => 5000000, // 5 MiB
            ]);
        ?>

        <?php echo $form->field($model, 'attachments')->widget(
            Upload::className(),
            [
                'url' => ['/file-storage/upload'],
                'sortable' => true,
                'maxFileSize' => 10000000, // 10 MiB
                'maxNumberOfFiles' => 10
            ]);
        ?>
    </div>



    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->getId()])->label(false); ?>

    <?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>Tourfirms::getTourfirmId(user()->getId())])->label(false); ?>

    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'submit' : 'submit']) ?>
<?php ActiveForm::end(); ?>
