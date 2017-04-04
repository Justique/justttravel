<?php
use common\models\Tourfirms;
use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Visa */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="wrapper">
<div class="visa-form">
    <?php $form = ActiveForm::begin(['action'=>'/user/visa/update?id='.$model->id,'options'=>['class'=>'make-order-form']]); ?>

    <div class="main-info">
        <?php if(userModel()->isUserTourOperator()) { ?>
        <label class="select">
            <?php echo $form->field($model, 'manager_id')->dropDownList(User::getManagersOfCompany(), ['prompt' => 'Менеджер'])->label(false) ?>
        </label>
            <?php }else{ ?>
        <label class="select">
            <?= $form->field($model, 'manager_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
        </label>
        <?php }?>
        <label class="select">
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </label>
        <label class="select">
            <?php
                echo $form->field($model, 'country_id')->dropDownList(\yii\helpers\ArrayHelper::map(\frontend\controllers\SiteController::getCountries(),'country_id','name'), [
                    'prompt' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'.$model->id
                ])->label(false);
            ?>
        </label>
        <label class="select">
        <?php echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
            'type' => 1,
            'options' => ['id'=>'subcat-id-id'.$model->id],
            'pluginOptions'=>[
                'depends'=>['cat-id-id'.$model->id],
                'placeholder' => 'Город',
                'url' => Url::to(['/site/cities'])
            ],
            'pluginEvents' => [
                "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
            ]
        ]);
        ?>
        </label>


        <label class="select">
        <?= $form->field($model, 'price')->textInput() ?>
        </label>

        <label class="select">
        <?= $form->field($model, 'documents')->textInput(['maxlength' => true]) ?>
        </label>

        <label class="select">
        <?= $form->field($model, 'type_time')->textInput() ?>
        </label>
        <label class="select">
        <?= $form->field($model, 'type')->textInput() ?>
        </label>

        <label class="select">
        <?= $form->field($model, 'name')->textInput() ?>
        </label>
        <label class="select">
        <?= $form->field($model, 'registration_period')->textInput() ?>
        </label>

        <?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>Tourfirms::getTourfirmId(user()->id)])->label(false)  ?>
        <?= $form->field($model, 'tour_id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'date_create')->hiddenInput(['value'=>time()])->label(false)  ?>
        <?= $form->field($model, 'date_update')->hiddenInput(['value'=>time()])->label(false)  ?>

        <div class="form-group">
            <?= Html::submitButton('Изменить', ['class' => 'button yellow']) ?>
            <?= Html::a("<i class='fa fa-trash'></i>". 'Удалить', ["/user/visa/delete?id=$model->id"],['class' => 'ajax-link button yellow trash','title'=>'удалить', "aria-label"=>'Удалить', 'data-confirm'=>'Вы уверены, что хотите удалить визу?','data-method'=>'post', 'data-pjax'=>0]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>

