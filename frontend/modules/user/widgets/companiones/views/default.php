<?php
use sjaakp\taggable\TagEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wrapper">
    <div class="wrapper-inner">
        <div class="head-symbol"><i class="fa fa-smile-o"></i></div>
        <h1>Создайте заявку</h1>
        <?php $form = ActiveForm::begin(['action'=>'/user/companiones/update?id='.$model->id]); ?>
        <div class=" textareas">
            <?= $form->field($model, 'travel_location')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'Куда вы планируете поехать?'])->label() ?>
            <?= $form->field($model, 'purpose_travel')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'Цель поездки'])->label() ?>
            <?= $form->field($model, 'about_me')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'О себе'])->label()  ?>
            <?= $form->field($model, 'about_traveler')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'О попутчике'])->label() ?>
            <?= $form->field($model, 'age_with')->textInput(['placeholder'=>'Возраст попутчика c'])->label() ?>
            <?= $form->field($model, 'age_to')->textInput(['placeholder'=>'Возраст попутчика до'])->label() ?>
            <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
        </div>
        <div class="nutrition-prefs">
            <?php
            $modGenders = \common\models\CompanionesGender::find()->all();
            $arr = [];
            foreach($modGenders as $item){
                $arr[$item->id] = $item->gender;
            }
            ?>
            <?= $form->field($model, 'gender_traveler')->radioList($arr) ?>
        </div>
        <p class="section">ИНТЕРЕСЫ:</p>
        <?= $form->field($model, 'editorTags')->widget(TagEditor::className(), [
            'tagEditorOptions' => [
                'autocomplete' => [
                    'source' => Url::toRoute(['interests/suggest'])
                ],
            ]
        ])->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton('Изменить', ['class' => 'button yellow']) ?>
            <?= Html::a("<i class='fa fa-trash'></i>". 'Удалить', ["/user/companiones/delete?id=$model->id"],['class' => 'ajax-link button yellow trash','title'=>'удалить', "aria-label"=>'Удалить', 'data-confirm'=>'Вы уверены, что хотите удалить заявку ?','data-method'=>'post', 'data-pjax'=>0]) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
