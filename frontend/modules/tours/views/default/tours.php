<?php

use common\models\Countries;
use common\models\Tourfirms;
use frontend\modules\tourfirms\Module as Module4;
use frontend\modules\tours\Module as Module3;
use frontend\modules\user\Module;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

?>
<div class="content-wrapper with-counter">
<h1>Все туры<span class="country-count"><?php echo  $dataProvider->getTotalCount() ?></span></h1>
<p>Туры всех турфирм из нашего каталога</p>
<div class="content-tours">
<?php
$form = ActiveForm::begin([
    'id'=>'tour-country-filter',
    'options'=>[
        'class'=>'regular-form'
    ]
]);
$modelCountries = new Countries();
$countries = Countries::find()->all();
$items = ArrayHelper::map($countries, 'country_id', 'name');
$option = '';
if(isset( yii::$app->request->get('ToursSearch')['country_to_id'])){
    $option = [yii::$app->request->get('ToursSearch')['country_to_id'] => ['selected ' => true ]];
}
echo $form->field($modelCountries, 'searchCountries')->dropDownList($items, ['prompt'=>'Выберете страну',   'options' =>$option])->label(false);
ActiveForm::end();
?>
<p class="sort">Сортировать по:<?php echo $sort->link('created_at')?><?php echo $sort->link('count_nights')?><?php echo $sort->link('price')?></p>

<ul class="tours-list">
    <?php foreach($dataProvider->getModels() as $item){ ?>
    <li class="<?php if($countComp = Module3::getComparison($item->id)){echo "green";} ?> comparing">
        <a href="/tour/<?php echo $item->slug ?>" class="tour-link"></a>
        <div class="tour-name">
            <a href="/tourfirm/<?php echo $item->tourfirm->slug ?>/info" class="blue"><?php echo $item->tourfirm->name ?></a>
            <div class="tour-rate">
                    <span class="rating-grade <?php echo Module4::getStyleForReviews((float)$item->tourfirm->rating ) ?>"><?php echo (float)$item->tourfirm->rating ?></span>
                    <?php if(user()->id){ ?>
                        <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $item->tourfirm_id ?>">рейтинг фирмы</a>
                    <?php }else{ ?>
                        <a class="login" href="#">рейтинг фирмы</a>
                    <?php } ?>
                </div>
            <p>добавлен <?php echo convertDate($item->published_at)?></p>
        </div>
        <div class="general">
            <div class="tour-type"><i class="fa fa-<?php echo $item->transport->class ?>"></i><span><?php echo $item->transport->type ?></span></div>
            <?php echo Module::getCountPeoples($item->count_old, $item->count_kids) ?>
            <?php if($item->hot){ ?>
                <div class="tour-hot visible">горящий тур</div>
            <?php } ?>
        </div>
        <div class="tour-destination">
            <i class="fa fa-map-marker"></i>
            <a href="/tours?ToursSearch[country_to_id]=<?php echo $item->country_to_id ?>" class="blue"><?php echo $item->country->name ?></a>
            <a href="/tours?ToursSearch[city_to_id]=<?php echo $item->city_to_id ?>" class="tour-destination__city"><?php echo $item->city->city ?></a>
        </div>
        <div class="tour-hotel">
            <?php if($item->hotel_title && $item->hotel_url && $item->hotel_rating): ?>
            <a href="<?=$item->hotel_url?>" class="blue"><?=$item->hotel_title?></a>
            <div class="tour-hotel-rate">
                <div class="rating-grade <?php echo Module4::getStyleForReviews((float)$item->hotel_rating) ?>" title="Рейтинг актуален на момент добавления тура. Текущий рейтинг вы можете посмотреть, перейдя по ссылке на отель"><?=$item->hotel_rating?></div>
                <a href="<?=$item->hotel_url?>">рейтинг Tophotels</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="tour-duration">
            <i class="fa fa-clock-o"></i>
            <p><?php echo $item->count_days ?> ночей</p>
            <p><?php echo $item->count_nights ?> дней</p>
        </div>
        <div class="tour-transport">
            <i class="fa fa-calendar-check-o"></i>
            <p><?php echo $item->fromCity->city ?></p>
            <p><?php echo $item->date_from ?></p>
        </div>
        <div class="tour-price">
            <p><?php echo $item->price ?><span>руб.</span></p>
            <?php if(!user()->id){ ?>
                <div>
                    <a href="#" class="login"><div class="tour-compare plus"></div></a>
                    <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                </div>
            <?php }else{ ?>
                <div>
                    <?php if($countComp){ ?>
                        <a href="/tours/comparison?comparison_save=0&tour_id=<?php echo $item->id ?>&tourfirm_id=<?php echo $item->tourfirm_id ?>"class="ajax-link"><div class="tour-compare minus"></div></a>
                    <?php }else{?>
                        <a href="/tours/comparison?comparison_save=1&tour_id=<?php echo $item->id ?>&tourfirm_id=<?php echo $item->tourfirm_id ?>"class="ajax-link"><div class="tour-compare plus"></div></a>
                    <?php }?>
                    <?php if(Module3::getFavorits($item->id)){ ?>
                        <div class="tour-like"><a href="/tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                    <?php }else{?>
                        <div class="tour-like"><a href="/tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </li>
    <?php } ?>
</ul>
</div>

    <?php echo LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
    ?>
</div>