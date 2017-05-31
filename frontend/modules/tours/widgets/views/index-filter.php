<?php

use common\models\Tours;
use common\models\Transports;
use frontend\controllers\SiteController;
use kartik\depdrop\DepDrop;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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
echo $form->field($m, 'TourSearchFilter[country_to_id]')->dropDownList($countries, [
    'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id'
])->label(false);
?>
<?php echo $form->field($m, 'TourSearchFilter[city_to_id]')->widget(DepDrop::classname(), [
    'type' => 1,
    'options' => ['id'=>'subcat-id', 'placeholder' => 'Любой курорт',],
    'pluginOptions'=>[
        'depends'=>['cat-id'],
        'placeholder' => 'Любой курорт',
        'url' => Url::to(['/site/cities']),
        
    ],
    'pluginEvents' => [
        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
    ]
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

<?php
echo $form->field($m, 'TourSearchFilter[country_from_id]')->dropDownList($countries, [
    'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'
])->label(false);
?>


<?php echo $form->field($m, 'TourSearchFilter[city_from_id]')->widget(DepDrop::classname(), [
    'type' => 1,
    'options' => ['id'=>'subcat-id-id', 'placeholder' => 'Из любого города',],
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