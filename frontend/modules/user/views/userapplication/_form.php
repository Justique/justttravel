<?php

use common\models\Transports;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use sjaakp\taggable\TagEditor;

/* @var $this yii\web\View */
/* @var $model common\models\UserApplication */
/* @var $form yii\widgets\ActiveForm */
$countries = ArrayHelper::map(frontend\controllers\SiteController::getCountries(),'country_id','name');
?>

<div class="user-application-form">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'make-order-form']]); ?>

    <?php echo \frontend\modules\user\widgets\status\Status::widget(['model'=>$model, 'name'=>'UserApplication[is_active]', 'field'=>'is_active']) ?>

    <div class="main-info">
        <div class="columns-4">
            <label class="select">
                <?php
                    echo $form->field($model, 'country_id')->dropDownList($countries, [
                        'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'
                    ])->label(false);
                ?>
            </label>

            <label class="select">
                <?php echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
                    'type' => 1,
                    'options' => ['id'=>'subcat-id'],
                    'pluginOptions'=>[
                        'depends'=>['cat-id-id'],
                        'placeholder' => 'Из любого города',
                        'url' => Url::to(['/site/cities'])
                    ],
                    'pluginEvents' => [
                        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
                    ]
                ])->label(false);
                ?>
            </label>

            <label class="select">
                <?php echo $form->field($model, 'resort_city')->widget(DepDrop::classname(), [
                    'type' => 1,
                    'options' => ['id'=>'subcat-id-id'],
                    'pluginOptions'=>[
                        'depends'=>['cat-id-id'],
                        'placeholder' => 'Любой курорт',
                        'url' => Url::to(['/site/cities'])
                    ],
                    'pluginEvents' => [
                        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
                    ]
                ])->label(false);
                ?>
             </label>

            <label class="select">
                <?php echo $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['placeholder' => 'Дата'],
                ])->label(false) ?>
            </label>

            <label class="select">
                <?= $form->field($model, 'price')->textInput(['placeholder'=>'Цена'])->label(false) ?>
            </label>

            <label class="select">
                <?php echo $form->field($model, 'adults')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Взрослых'])->label(false) ?>
            </label>

            <label class="select">
                <?php echo $form->field($model, 'childrens')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Детей'])->label(false) ?>
            </label>


            <label class="select">
                <?php
                echo $form->field($model, 'country_from_id')->dropDownList($countries, [
                    'prompt' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id-id'
                ])->label(false);
                ?>
            </label>

            <label class="select">
                <?php echo $form->field($model, 'shopping_city')->widget(DepDrop::classname(), [
                    'type' => 1,
                    'options' => ['id'=>'subcat-id-id-id'],
                    'pluginOptions'=>[
                        'depends'=>['cat-id-id-id'],
                        'placeholder' => 'Город покупки тура',
                        'url' => Url::to(['/site/cities'])
                    ],
                    'pluginEvents' => [
                        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
                    ]
                ])->label(false);
                ?>
            </label>

            <label class="select">
                <?php echo $form->field($model, 'days')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Дней'])->label(false) ?>
            </label>

            <label class="select">
                <?php echo $form->field($model, 'nights')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Ночей'])->label(false) ?>
            </label>

            <?php
                $transports = Transports::find()->all();
                $items = ArrayHelper::map($transports,'id','type');
            ?>

            <label class="select">
                <?php echo $form->field($model, 'transport_type')->dropDownList($items, ['prompt' => 'Вид транспорта'])->label(false) ?>
            </label>
        </div>

        <div class="section">
            <label class="control-label" for="userapplication-comment">ОТЕЛЬ:</label>
            <div class="hotel-prefs">
                <?= $form->field($model, 'hotels')->widget(TagEditor::className(), [
                    'tagEditorOptions' => [
                        'placeholder'=> 'Названия отелей...',
                    ]
                ])->label(false) ?>
                <a class="interest_button">ДОБАВИТЬ</a>
            </div>
        </div>

        <div style="display: none">
            <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
        </div>

        <?php echo $form->field($model, 'comment')->widget(
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
        ) ?>
        <?php if($model->isNewRecord) {  ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'submit' : 'submit']) ?>
            </div>
        <?php }else{ ?>
            <div class="container buttons">
                <?= Html::submitButton('Сохранить', ['class' => 'button yellow']) ?>
                <?= Html::a("<i class='fa fa-trash'></i>". 'Удалить Заявку', ["/user/userapplication/delete?id=$model->id"],['class' => 'ajax-link button yellow trash','title'=>'удалить', "aria-label"=>'Удалить', 'data-confirm'=>'Вы уверены, что хотите удалить эту заявку?','data-method'=>'post', 'data-pjax'=>0]) ?>
            </div>
        <?php } ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


