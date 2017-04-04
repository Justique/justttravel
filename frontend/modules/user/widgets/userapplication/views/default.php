<?php
use common\models\Transports;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$countries = ArrayHelper::map(SiteController::getCountries(),'country_id','name');

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */
?>

<?php $form = ActiveForm::begin(['options'=>['class'=>'ajax-form'], 'action'=>"/user/userapplication/update?id=$model->id"]); ?>

<?= $form->field($model, 'is_active')->checkbox(['id'=>'order_activity']) ?>

<?php
    echo $form->field($model, 'country_id')->dropDownList($countries, [
        'prompt' => 'Любая страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id'.$model->id
    ])->label(false);
?>

<?php echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
    'type' => 1,
    'options' => ['id'=>'subcat-id'.$model->id],
    'pluginOptions'=>[
        'depends'=>['cat-id-id'.$model->id],
        'placeholder' => 'Из любого города',
        'url' => Url::to(['/site/cities'])
    ],
    'pluginEvents' => [
        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
    ]
])->label(false);
?>

<?php echo $form->field($model, 'resort_city')->widget(DepDrop::classname(), [
    'type' => 1,
    'options' => ['id'=>'subcat-id-id'.$model->id],
    'pluginOptions'=>[
        'depends'=>['cat-id-id'.$model->id],
        'placeholder' => 'Любой курорт',
        'url' => Url::to(['/site/cities'])
    ],
    'pluginEvents' => [
        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
    ]
])->label(false);
?>
<?php echo $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
    'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'options'=>[
        'placeholder' => 'Дата',
        'id'=> 'applicationfortours-date'.$model->id
    ],
])->label(false) ?>

<?= $form->field($model, 'price')->textInput()->label(false); ?>

<?php echo $form->field($model, 'adults')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Взрослых'])->label(false) ?>

<?php echo $form->field($model, 'childrens')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Детей'])->label(false) ?>


<?php
    echo $form->field($model, 'country_from_id')->dropDownList($countries, [
        'prompt' => 'Страна','class' => 'select user-form firm-form', 'id'=>'cat-id-id-id'.$model->id
    ])->label(false);
?>

<?php echo $form->field($model, 'shopping_city')->widget(DepDrop::classname(), [
    'type' => 1,
    'options' => ['id'=>'subcat-id-id-id'.$model->id],
    'pluginOptions'=>[
        'depends'=>['cat-id-id-id'.$model->id],
        'placeholder' => 'Город покупки тура',
        'url' => Url::to(['/site/cities'])
    ],
    'pluginEvents' => [
        "depdrop.afterChange"=>"function(event, id, value) { $('select').dropdown('update');}",
    ]
])->label(false);
?>
<?php echo $form->field($model, 'days')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Дней'])->label(false) ?>
<?php echo $form->field($model, 'nights')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Ночей'])->label(false) ?>

<?= $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>
<?php
$transports = Transports::find()->all();
$items = ArrayHelper::map($transports,'id','type');
?>
<?php echo $form->field($model, 'transport_type')->dropDownList($items, ['prompt' => 'Вид транспорта'])->label(false) ?>
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
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'button yellow']) ?>
    <?= Html::a("<i class='fa fa-trash'></i>". 'Удалить Заявку', ["/user/userapplication/delete?id=$model->id"],['class' => 'ajax-link button yellow trash','title'=>'удалить', "aria-label"=>'Удалить', 'data-confirm'=>'Вы уверены, что хотите удалить эту заявку?','data-method'=>'post', 'data-pjax'=>0]) ?>
</div>
<?php ActiveForm::end(); ?>
<?php dump(1234) ?>

<?php if($responsesProvider->getModels()){ ?>
    <?php \yii\widgets\Pjax::begin() ?>

    <h2>Отклики на заявку</h2>
<ul class="tours-list">
    <?php foreach($responsesProvider->getModels() as $item) { ?>
        <li>
            <div class="general">
                <?php if(($item->transport_type)) { ?>
                    <div class="tour-type"><i class="fa fa-<?php echo $item->transport->class ?>"></i><span><?php echo $item->transport->about ?></span></div>
                <?php } ?>
                <?php echo \frontend\modules\user\Module::getCountPeoples($item->childrens, $item->adults) ?>
            </div>
            <div class="tour-name">
                <a href="/profile/messages?messager_id=<?php echo $item->manager_id ?>" class="blue"><?php echo $item->user->username ?></a>
                <div class="tour-rate">
                    <div class="green rating-grade">5.00</div>
                    <a href="">рейтинг фирмы</a>
                </div>
                <p>добавлен <?php echo convertDate($item->date_update)?></p>
            </div>
            <div class="tour-destination">
                <a href="" class="blue"><?php echo $item->country->name ?></a>
                <a href=""><?php echo $item->city->city ?></a>
            </div>
            <div class="tour-duration">
                <p><?php echo $item->nights ?> ночей</p>
                <p><?php echo $item->days ?> дней</p>
            </div>
            <div class="tour-hotel">
                <a href="" class="blue">Golden Tulip Khatt Sprin...</a>
                <div class="tour-hotel-rate">
                    <div class="rating-grade lime">4.05</div>
                    <a href="">рейтинг Tophotels</a>
                </div>
                <p>BB (только завтрак)</p>
            </div>
            <div class="tour-price">
                <p><?php echo $item->price ?> <span>руб</span></p>
            </div>
        </li>
    <?php } ?>
</ul>
    <?php echo \yii\widgets\LinkPager::widget([
            'pagination' => $responsesProvider->pagination,
        ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
<?php }else{ ?>
    <h2>Откликов нету</h2>
<?php } ?>

