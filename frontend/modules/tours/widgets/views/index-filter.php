<?php

use common\models\Tours;
use common\models\Transports;
use frontend\controllers\SiteController;
use kartik\depdrop\DepDrop;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
$countries = ArrayHelper::map(SiteController::getCountries(),'country_id','name');

?>
<?php $form = ActiveForm::begin(['action'=>'/tours', 'method'=>'GET']); ?>
<?php
$m = new  Tours();
?>
<?php

echo $form->field($m, 'TourSearchFilter[country_to_id]')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(SiteController::getCountries(),'country_id','name'),
    'language' => 'ru',
    'options' => ['placeholder' => 'Любая страна','class' => 'select user-form firm-form is-select2', 'id'=>'cat-id', 'name' => 'ToursSearch[country_to_id]'],
    'pluginOptions' => [
        'allowClear' => false
    ],
])->label(false);
?>
<?php echo $form->field($m, 'TourSearchFilter[city_to_id]')->widget(Select2::classname(), [
    'options' => ['id'=>'subcat-id', 'class' => 'is-select2', 'name' => 'ToursSearch[city_to_id]'],
    'pluginOptions' => [
        'placeholder' => 'Любой курорт',
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

<div class="form-group">
    <?= DateRangePicker::widget([
        'name' => 'ToursSearch[date]',
        'value' => date('d.m.Y') . ' - ' . date('d.m.Y', strtotime('+7 day')),
        'convertFormat' => true,
        'pluginOptions' => [
            'locale' => ['format' => 'd.m.Y'],
        ]
    ]) ?>
</div>

<?php echo $form->field($m, 'TourSearchFilter[country_from_id]')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(SiteController::getCountries(),'country_id','name'),
    'language' => 'ru',
    'options' => ['placeholder' => 'Из любой страны','class' => 'select user-form firm-form is-select2', 'id'=>'cat-id-id', 'name' => 'ToursSearch[country_from_id]'],
    'pluginOptions' => [
        'allowClear' => false
    ],
])->label(false);
?>

<?php echo $form->field($m, 'TourSearchFilter[city_from_id]')->widget(Select2::classname(), [
    'options' => ['id'=>'subcat-id-id', 'class' => 'is-select2', 'name' => 'ToursSearch[city_id]'],
    'pluginOptions' => [
        'placeholder' => 'Из любого города',
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

<?php
$transports = Transports::find()->all();
$items = ArrayHelper::map($transports,'id','type');
?>
<?php echo $form->field($m, 'TourSearchFilter[transport_type]')->dropDownList($items, ['prompt' => 'Вид транспорта'])->label(false) ?>
    <div class="extended">
        <a href="" class="extended_serch_trigger">расширенный поиск</a>
        <div class="content">
            <div class="row">
            	<label class="label__stars">количество звёзд отеля</label>
                <input type="checkbox" id="num_1">
                <label for="num_1"><i class="fa fa-check-square"></i><span>1</span></label>
                <input type="checkbox" id="num_2">
                <label for="num_2"><i class="fa fa-check-square"></i><span>2</span></label>
                <input type="checkbox" id="num_3">
                <label for="num_3"><i class="fa fa-check-square"></i><span>3</span></label>
                <input type="checkbox" id="num_4">
                <label for="num_4"><i class="fa fa-check-square"></i><span>4</span></label>
                <input type="checkbox" id="num_5">
                <label for="num_5"><i class="fa fa-check-square"></i><span>5</span></label>
            </div>
            <div class="row">
                <label class="selects">
                    <?php echo $form->field($m, 'Price[price_with]')->dropDownList(array_combine(range(500, 5000, 500),range(500, 5000, 500)), ['prompt' => 'Цена от']) ?>
                </label>
            </div>
            <div class="row">
                <label class="selects">
                    <?php echo $form->field($m, 'Price[price_to]')->dropDownList(array_combine(range(5000, 500, 500),range(5000, 500, 500)), ['prompt' => 'Цена до']) ?>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Поехали', ['class' =>'button yellow']) ?>
    </div>

<?php ActiveForm::end(); ?>