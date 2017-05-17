<?php
use common\models\Transports;
use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$countries = ArrayHelper::map(frontend\controllers\SiteController::getCountries(),'country_id','name');

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */
?>
    <?php $form = ActiveForm::begin(['action'=>'/user/tours/update?id='.$model->id, 'options'=>['class'=>'make-order-form']]); ?>
    <h2>Редактировать тур</h2>
    <div class="main-info">
        <div class="trigger_container">
            <input type="checkbox" id="autoup_trigger" name="autoup_trigger" checked><label for="autoup_trigger">автоап тура <span class="checked">включен (каждые сутки в 15:00)</span><span class="unchecked">выключен</span></label>
        </div>
        <?php if(userModel()->isUserTourOperator()) { ?>
        <label class="select">
            <?php echo $form->field($model, 'user_id')->dropDownList(User::getManagersOfCompany(), ['prompt' => 'Менеджер'])->label(false) ?>
        </label>
        <?php }else{ ?>
        <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>

        <?php }?>
        <label class="select">
        <?= $form->field($model, 'title')->textInput(['placeholder'=>'Название тура','maxlength' => true])->label(false) ?>
        </label>
        <label class="select">
        <?= $form->field($model, 'price')->textInput(['placeholder'=>'Стоимость','maxlength' => true])->label(false) ?>
        </label>
        <label class="select">
        <?php
            echo $form->field($model, 'country_to_id')->dropDownList($countries, [
                'prompt' => 'Страна назначения','class' => 'select user-form firm-form', 'id'=>'cat-id'.$model->id
            ])->label(false);
        ?>
       
        </label>
        <label class="select">
        <?php echo $form->field($model, 'city_to_id')->widget(DepDrop::classname(), [
            'type' => 1,
            'options' => ['id'=>'subcat-id'.$model->id],
            'pluginOptions'=>[
                'depends'=>['cat-id'.$model->id],
                'placeholder' => 'Выберите город назначения',
                'url' => Url::to(['/site/cities'])
            ],
            'pluginEvents' => [
                "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
            ]
        ])->label(false);
        ?>
        </label>
        <label class="select">
            <?php
            echo $form->field($model, 'country_from_id')->dropDownList($countries, [
                'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'.$model->id
            ])->label(false);
            ?>
       
        </label>
        <label class="select">
        <?php echo $form->field($model, 'city_from_id')->widget(DepDrop::classname(), [
            'type' => 1,
            'options' => ['id'=>'subcat-id-id'.$model->id],
            'pluginOptions'=>[
                'depends'=>['cat-id-id'.$model->id],
                'placeholder' => 'Выберите город вылета',
                'url' => Url::to(['/site/cities'])
            ],
            'pluginEvents' => [
                "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
            ]
        ])->label(false);
        ?>
        </label>
        <label class="select">
        <?php echo $form->field($model, 'date_from')->widget(\yii\jui\DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options'=>[
                'placeholder' => 'Дата',
                'id'=> 'applicationfortours-date'.$model->id
            ],
        ])->label(false) ?>
        </label>
        <label class="select">
        <?php echo $form->field($model, 'count_old')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Взрослых'])->label(false) ?>
        </label>

        <label class="select">
        <?php echo $form->field($model, 'count_kids')->dropDownList(range(0,12), ['prompt' => 'Детей'])->label(false) ?>
        </label>

        <label class="select">
        <?php echo $form->field($model, 'count_days')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Дней'])->label(false) ?>
        </label>

        <label class="select">
        <?php echo $form->field($model, 'count_nights')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Ночей'])->label(false) ?>
        </label>


        <?php
        $transports = Transports::find()->all();
        $items = ArrayHelper::map($transports,'id','type');
        ?>

        <?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>\common\models\Tourfirms::getTourfirmId(user()->id)])->label(false) ?>


        <p class="section">ТИП транспорта:</p>
        <div class="nutrition-prefs">
            <input style="display: none" name="Tours[transport_type]" <?php if($model->transport_type == 1){echo 'checked'; } ?>  value="1" type="radio" id="transport_air">
            <label for="transport_air"> авиа</label>
            <input style="display: none" name="Tours[transport_type]" <?php if($model->transport_type == 2){echo 'checked'; } ?>   value="2" type="radio" id="transport_bus">
            <label for="transport_bus">автобус</label>
            <input style="display: none" name="Tours[transport_type]" <?php if($model->transport_type == 3){echo 'checked'; } ?>   value="3" type="radio" id="transport_sea">
            <label for="transport_sea">морской</label>
            <input style="display: none" name="Tours[transport_type]" <?php if($model->transport_type == 4){echo 'checked'; } ?>  value="4" type="radio" id="transport_railway">
            <label for="transport_railway">ЖД</label>
        </div>
        <p class="section">Горящий тур</p>
        <div class="nutrition-prefs">
            <input type="checkbox" value="1" <?php if($model->hot == 1){echo 'checked'; } ?>  name="Tours[hot]" id="is_hot">
            <label for="is_hot"> да</label>
        </div>
        
        <p class="section">Отель</p>
        <div class="">
            <label class="select">
                <?= $form->field($model, 'hotel_title')->textInput(['placeholder'=>'Название отеля','maxlength' => true])->label(false) ?>
            </label>
            <label class="select">
                <?= $form->field($model, 'hotel_url')->textInput(['placeholder'=>'Ссылка на отель','maxlength' => true])->label(false) ?>
            </label>
            <label class="select">
                <?= $form->field($model, 'hotel_rating')->textInput(['placeholder'=>'Рейтинг отеля','maxlength' => 4])->label(false) ?>
            </label>

        </div>

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
        ) ?>

        <?php echo $form->field($model, 'attachments')->widget(
            \trntv\filekit\widget\Upload::className(),
            [
                'url' => ['/file-storage/upload'],
                'sortable' => true,
                'maxFileSize' => 10000000, // 10 MiB
                'maxNumberOfFiles' => 10
            ]);
        ?>
        <?php /*echo $form->field($model, 'thumbnail')->widget(
    Upload::className(),
    [
    'url' => ['/file-storage/upload'],
    'maxFileSize' => 5000000, // 5 MiB
    ]);
    */?>
            <?= Html::submitButton('Изменить', ['class' => 'submit']) ?>
            <?= Html::a('<i class="fa fa-trash"></i>', ["/user/tours/delete?id=$model->id"], [
                'class' => 'delete_trigger',
                'title' => 'удалить',
                'aria-label' => 'Удалить',
                'data-confirm' => 'Вы уверены, что хотите удалить тур '.$model->title." ?",
                'data-method' => 'post'
            ]) ?>
    </div>
    <?php ActiveForm::end(); ?>
