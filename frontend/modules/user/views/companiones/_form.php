<?php
use common\models\Cities;
use common\models\Countries;
use sjaakp\taggable\TagEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Companiones */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.tag-editor {
padding: 0 100px 0 0;
float:left;
}

.interest_button:hover{
cursor: pointer;
}
</style>
        <?php $form = ActiveForm::begin(['options'=>['class'=>'make-order-form create-req-form']]); ?>
            <div class="container textareas">
                <?= $form->field($model, 'travel_location')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'Куда вы планируете поехать?'])->label(false) ?>
                <?= $form->field($model, 'purpose_travel')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'Цель поездки'])->label(false) ?>
                <?= $form->field($model, 'about_me')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'О себе'])->label(false)  ?>
                <?= $form->field($model, 'about_traveler')->textarea(['cols' => 30, 'rows'=>3, 'placeholder'=>'О попутчике'])->label(false) ?>
                <?= $form->field($model, 'age_with')->textInput(['placeholder'=>'Возраст попутчика c'])->label(false) ?>
                <?= $form->field($model, 'age_to')->textInput(['placeholder'=>'Возраст попутчика до'])->label(false) ?>
            </div>
                <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>

            <div class="container nutrition-prefs">
                <input style="display: none" type="radio" name="Companiones[gender_traveler]" value="2" id="order-women"><label for="order-women">ищу женщину</label>
                <input style="display: none" type="radio" name="Companiones[gender_traveler]" value="3" id="order-man"><label for="order-man">ищу мужчину</label>
                <input style="display: none" type="radio" name="Companiones[gender_traveler]" value="1" id="order-company"><label for="order-company">ищу компанию</label>
            </div>


            <p class="section">ИНТЕРЕСЫ:</p>
             <div class="hotel-prefs">
            <?= $form->field($model, 'editorTags')->widget(TagEditor::className(), [
            'tagEditorOptions' => [
                'placeholder'=>'Ваши интересы в путешествии...',
                'autocomplete' => [
                    'source' => Url::toRoute(['interests/suggest'])
                ],
            ]
            ])->label(false) ?>
             <a class="interest_button">ДОБАВИТЬ</a>
            </div>
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'submit' : 'submit']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <h2>Мои заявки</h2>
    <div style="" class="companions-container">
        <?php foreach($myCompaniones as $item){ ?>
            <article>
            <div class="main-info">
                <div class="creds">
                    <a href="#">
                        <img src="img/user-1.jpg" alt="">
                        <i class="fa fa-comment"></i>
                    </a>
                    <div>
                        <p class="name"><span><?php echo $item->myCompaniones->firstname?>  <?php echo $item->myCompaniones->lastname?></span><span class="age violet"><?php echo $item->myCompaniones->byear?>лет</span><span class="location"><?php echo Countries::getCountry($item->myCompaniones->country)?>, <?php echo Cities::getCity($item->myCompaniones->country)?></span></p>
                        <div><i class="fa fa-transgender"></i>Ищу в попутчики компанию</div>
                        <div><i class="fa fa-user"></i>Возраст <?php echo $item->age_with?></div>
                    </div>
                </div>
                <div class="target">
                    <p class="destination"><?php echo $item->travel_location?></p>
                    <p><span>Цель поездки:</span><?php echo $item->purpose_travel?></p>
                    <p><span>О себе:</span> <?php echo $item->about_me?></p>
                    <p><span>О попутчике:</span> <?php echo $item->about_traveler?></p>
                </div>
            </div>
            <a href="#" class="tag">лыжи</a>
            <a href="#" class="tag">сноуборд</a>
        </article>
        <?php } ?>