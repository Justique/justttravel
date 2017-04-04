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
            <div class="tour-name">
                <a href="/tour/<?php echo $item->tour->slug ?>" class="blue"><?php echo $item->tour->title ?></a>
                <div class="tour-rate">
                    <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews((float)$item->tour->tourfirm->rating ) ?>"><?php echo (float)$item->tour->tourfirm->rating ?></span>
                    <?php if(user()->id){ ?>
                        <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $item->tour->tourfirm_id ?>">рейтинг фирмы</a>
                    <?php }else{ ?>
                        <a class="login" href="#">рейтинг фирмы</a>
                    <?php } ?>
                </div>
                <p>добавлен <?php echo convertDate($item->tour->published_at)?></p>
            </div>
            <div class="tour-destination">
                <a href="/tours?ToursSearch[country_to_id]=<?php echo $item->tour->country_to_id ?>" class="blue"><?php echo Countries::getCountry($item->tour->country_to_id) ?></a>
                <a href="/tours?ToursSearch[city_to_id]=<?php echo $item->tour->city_to_id ?>"><?php echo Cities::getCity($item->tour->city_to_id) ?></a>
            </div>
            <div class="tour-duration">
                <p><?php echo $item->tour->count_nights ?> ночей</p>
                <p><?php echo $item->tour->count_days ?>  дней</p>
            </div>
            <div class="tour-transport">
                <i class="fa fa-<?php echo $item->tour->transport->class ?>"></i>
                <p><?php echo Cities::getCity($item->tour->city_from_id) ?></p>
                <p><?php echo $item->tour->date_from ?></p>
            </div>
            <div class="tour-capacity">
                <?php if(!$item->tour->count_kids){ ?>
                    <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class=""></i></p>
                    <p>взрослыe - <?php echo $item->tour->count_old ?> </p>
                <?php }else{ ?>
                    <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-child"></i></p>
                    <p>взрослыe - <?php echo $item->tour->count_old ?><span> дети - <?php echo $item->tour->count_kids ?></span></p>
                <?php }?>

            </div>
            <div class="tour-price">
                <?php if($item->tour->hot){ ?>
                    <div class="tour-hot visible">горящий тур</div>
                <?php } ?>
                <p><?php echo $item->tour->price ?><span>rub.</span></p>
                <?php if(!user()->id){ ?>
                    <div>
                        <a href="#" class="login"><div class="tour-compare plus"></div></a>
                        <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                    </div>
                <?php }else{ ?>
                    <div>
                        <a href="/tours/comparison?comparison_save=0&tour_id=<?php echo $item->tour->id ?>&tourfirm_id=<?php echo $item->tour->tourfirm_id ?>"class="ajax-link"><div class="tour-compare minus"></div></a>
                        <?php if(\frontend\modules\tours\Module::getFavorits($item->tour->id)){ ?>
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

