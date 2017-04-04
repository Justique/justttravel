<?php
use common\models\Cities;
use common\models\Countries;
use yii\widgets\LinkPager;

?>
<div class="comparison-default-index">
    <div class="content-wrapper with-counter">
        <h1>Туры для сравнения <span class="country-count"><?php echo  count($models) ?></span></h1>

<?php
//$form = ActiveForm::begin([
//    'id'=>'tour-country-filter',
//    'options'=>[
//        'class'=>'regular-form'
//    ]
//]);
//$modelCountries = new Countries();
//$countries = Countries::find()->all();
//$items = ArrayHelper::map($countries, 'country_id', 'name');
//$option = '';
//if(isset( yii::$app->request->get('ToursSearch')['country_to_id'])){
//    $option = [yii::$app->request->get('ToursSearch')['country_to_id'] => ['selected ' => true ]];
//}
//echo $form->field($modelCountries, 'searchCountries')->dropDownList($items, ['prompt'=>'Выберете страну',   'options' =>$option])->label(false);
//ActiveForm::end();
//?>
<p class="sort">Сортировать по:
    <?php echo $sort->link('created_at')?>
    <!----><?php echo $sort->link('count_nights')?>
    <!----><?php echo $sort->link('price')?>
    </p>

<ul class="tours-list">
    <?php foreach($models as $item){?>
        <li class="<?php if($countComp = \frontend\modules\tours\Module::getComparison($item->tour->id)){echo "green";} ?> comparing">
            <a href="/tour/<?php echo $item->tour->slug ?>" class="tour-link"></a>
            <div class="tour-name">
                <a href="/tourfirm/<?php echo $item->tour->tourfirm->slug ?>/info" class="blue"><?php echo $item->tour->tourfirm->name ?></a>
                <div class="tour-rate">
                        <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews($item->tour->tourfirm->rating) ?>"><?php echo (float)$item->tour->tourfirm->rating ?></span>
                        <?php if(user()->id){ ?>
                            <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $item->tour->tourfirm_id ?>">рейтинг фирмы</a>
                        <?php }else{ ?>
                            <a class="login" href="#">рейтинг фирмы</a>
                        <?php } ?>
                    </div>
                <p>добавлен <?php echo convertDate($item->tour->published_at)?></p>
            </div>
            <div class="general">
                <div class="tour-type"><i class="fa fa-<?php echo $item->tour->transport->class ?>"></i><span><?php echo $item->tour->transport->type ?></span></div>
                <?php echo frontend\modules\user\Module::getCountPeoples($item->tour->count_old, $item->tour->count_kids) ?>
                <?php if($item->tour->hot){ ?>
                    <div class="tour-hot visible">горящий тур</div>
                <?php } ?>
            </div>
            <div class="tour-destination">
                <i class="fa fa-map-marker"></i>
                <a href="/tours?ToursSearch[country_to_id]=<?php echo $item->tour->country_to_id ?>" class="blue"><?php echo $item->tour->country->name ?></a>
                <a href="/tours?ToursSearch[city_to_id]=<?php echo $item->tour->city_to_id ?>" class="tour-destination__city"><?php echo $item->tour->city->city ?></a>
            </div>
            <div class="tour-hotel">
                <?php if($item->tour->hotel_title && $item->tour->hotel_url && $item->tour->hotel_rating): ?>
                <a href="<?=$item->tour->hotel_url?>" class="blue"><?=$item->tour->hotel_title?></a>
                <div class="tour-hotel-rate">
                    <div class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews((float)$item->tour->hotel_rating) ?>" title="Рейтинг актуален на момент добавления тура. Текущий рейтинг вы можете посмотреть, перейдя по ссылке на отель"><?=$item->tour->hotel_rating?></div>
                    <a href="<?=$item->tour->hotel_url?>">рейтинг Tophotels</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="tour-duration">
                <i class="fa fa-clock-o"></i>
                <p><?php echo $item->tour->count_days ?> ночей</p>
                <p><?php echo $item->tour->count_nights ?> дней</p>
            </div>
            <div class="tour-transport">
                <i class="fa fa-calendar-check-o"></i>
                <p><?php echo $item->tour->fromCity->city ?></p>
                <p><?php echo $item->tour->date_from ?></p>
            </div>
            <div class="tour-price">
                <p><?php echo $item->tour->price ?><span>руб.</span></p>
                <?php if(!user()->id){ ?>
                    <div>
                        <a href="#" class="login"><div class="tour-compare plus"></div></a>
                        <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                    </div>
                <?php }else{ ?>
                    <div>
                        <?php if($countComp){ ?>
                            <a href="/tours/comparison?comparison_save=0&tour_id=<?php echo $item->tour->id ?>&tourfirm_id=<?php echo $item->tour->tourfirm_id ?>"class="ajax-link"><div class="tour-compare minus"></div></a>
                        <?php }else{?>
                            <a href="/tours/comparison?comparison_save=1&tour_id=<?php echo $item->tour->id ?>&tourfirm_id=<?php echo $item->tour->tourfirm_id ?>"class="ajax-link"><div class="tour-compare plus"></div></a>
                        <?php }?>


                        <?php if(frontend\modules\tours\Module::getFavorits($item->tour->id)){ ?>
                            <div class="tour-like"><a href="/tours/favorits?save=0&tour_id=<?php echo $item->tour->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                        <?php }else{?>
                            <div class="tour-like"><a href="/tours/favorits?save=1&tour_id=<?php echo $item->tour->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </li>
        
        
        
    <?php } ?>
</ul>
        <?php echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
</div>

