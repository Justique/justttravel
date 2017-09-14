<?php
use common\models\Transports;
use common\models\User;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use frontend\controllers\SiteController;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$countries = ArrayHelper::map(frontend\controllers\SiteController::getCountries(),'country_id','name');
?>
<?php $form = ActiveForm::begin(['options'=>['class'=>'make-order-form']]); ?>

<div class="main-info">
    <?php if(userModel()->isUserTourOperator()) { ?>
        <label class="select">
            <?php echo $form->field($model, 'user_id')->dropDownList(User::getManagersOfCompany(), ['prompt' => 'Менеджер'])->label(false) ?>
        </label>
    <?php }else{ ?>
        <label class="select">
            <?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
        </label>

    <?php }?>
    <label class="select">
        <?= $form->field($model, 'title')->textInput(['placeholder'=>'Название тура','maxlength' => true])->label(false) ?>
    </label>
    <label class="select">
        <?= $form->field($model, 'price')->textInput(['placeholder'=>'Стоимость','maxlength' => true])->label(false) ?>
    </label>
    <label class="select">
        <?php
       /* echo $form->field($model, 'country_to_id')->dropDownList($countries, [
            'prompt' => 'Страна назначения','class' => 'select user-form firm-form', 'id'=>'cat-id'.$model->id
        ])->label(false);
		*/
		echo $form->field($model, 'country_to_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(SiteController::getCountries(),'country_id','name'),
			'language' => 'ru',
			'options' => ['placeholder' => 'Страна назначения','class' => 'select user-form firm-form is-select2', 'id'=>'cat-id'],
			'pluginOptions' => [
				'allowClear' => false
			],
		])->label(false);
        ?>
       
    </label>
    <label class="select">
        <?php /*echo $form->field($model, 'city_to_id')->widget(DepDrop::classname(), [
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
        ])->label(false);*/
		
		echo $form->field($model, 'city_to_id')->widget(Select2::classname(), [
			'options' => ['id'=>'subcat-id', 'class' => 'is-select2'],
			'pluginOptions' => [
				'placeholder' => 'Выберите город назначения',
				'allowClear' => true,
				'minimumInputLength' => 1,
				'ajax' => [
					'url' => Url::to(['/site/search-cities']),
					'dataType' => 'json',
					'data' => new JsExpression('function(params) { return {q:params.term, pid:$("#cat-id").val()}; }')
				],
			],
		])->label(false);
		
        ?>
    </label>
    <label class="select">
        <?php
        /*echo $form->field($model, 'country_from_id')->dropDownList($countries, [
            'prompt' => 'Страна вылета','class' => 'select user-form firm-form', 'id'=>'cat-id-id'.$model->id
        ])->label(false);*/
		
		echo $form->field($model, 'country_from_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(SiteController::getCountries(),'country_id','name'),
			'language' => 'ru',
			'options' => ['placeholder' => 'Страна вылета','class' => 'select user-form firm-form is-select2', 'id'=>'cat-id-id'],
			'pluginOptions' => [
				'allowClear' => false
			],
		])->label(false);
        ?>
    </label>
    <label class="select">
        <?php /*echo $form->field($model, 'city_from_id')->widget(DepDrop::classname(), [
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
        ])->label(false);*/
		
		echo $form->field($model, 'city_from_id')->widget(Select2::classname(), [
			'options' => ['id'=>'subcat-id-id', 'class' => 'is-select2'],
			'pluginOptions' => [
				'placeholder' => 'Выберите город вылета',
				'allowClear' => true,
				'minimumInputLength' => 2,
				'ajax' => [
					'url' => Url::to(['/site/search-cities']),
					'dataType' => 'json',
					'data' => new JsExpression('function(params) { return {q:params.term, pid:$("#cat-id-id").val()}; }')
				],
			],
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

<!--    <label class="select">-->
<!--        --><?php //echo $form->field($model, 'transport_type')->dropDownList($items, ['prompt' => 'Вид транспорта'])->label(false) ?>
<!--    </label>-->


        <?= $form->field($model, 'tourfirm_id')->hiddenInput(['value'=>\common\models\Tourfirms::getTourfirmId(user()->id)])->label(false) ?>

    <p class="section">ТИП транспорта:</p>
    <div class="nutrition-prefs">
        <input style="display: none" name="Tours[transport_type]" checked value="1" type="radio" id="transport_air">
        <label for="transport_air"> авиа</label>
        <input style="display: none" name="Tours[transport_type]"  value="2" type="radio" id="transport_bus">
        <label for="transport_bus">автобус</label>
        <input style="display: none" name="Tours[transport_type]"  value="3" type="radio" id="transport_sea">
        <label for="transport_sea">морской</label>
        <input style="display: none" name="Tours[transport_type]"  value="4" type="radio" id="transport_railway">
        <label for="transport_railway">ЖД</label>
    </div>
    <p class="section">Горящий тур</p>
    <div class="nutrition-prefs">
        <input type="checkbox" value="1" name="Tours[hot]" id="is_hot">
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
    
    <p class="section">Описание</p>
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
    <?= Html::submitButton('Добавить', ['class' => 'submit']) ?>
</div>
<?php ActiveForm::end(); ?>
