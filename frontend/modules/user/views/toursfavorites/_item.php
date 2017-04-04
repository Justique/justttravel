<?php
use common\models\Cities;
use common\models\Countries;
?>
<li>
    <div class="tour-name">
        <a href="/tour/<?php echo $model->tour->slug ?>" class="blue"><?php echo $model->tour->title ?></a>
        <div class="tour-rate">
            <div class="lime-orange rating-grade">3.80</div>
            <a href="">рейтинг фирмы</a>
        </div>
        <p>добавлен <?php echo convertDate($model->tour->published_at)?></p>
    </div>
    <div class="tour-destination">
        <a href="/tours?ToursSearch[country_to_id]=<?php echo $model->tour->country_to_id ?>" class="blue"><?php echo Countries::getCountry($model->tour->country_to_id) ?></a>
        <a href="/tours?ToursSearch[city_to_id]=<?php echo $model->tour->city_to_id ?>"><?php echo Cities::getCity($model->tour->city_to_id) ?></a>
    </div>
    <div class="tour-duration">
        <p><?php echo $model->tour->count_nights ?> ночей</p>
        <p><?php echo $model->tour->count_days ?>  дней</p>
    </div>
    <div class="tour-transport">
        <i class="fa fa-<?php echo $model->tour->transport->class ?>"></i>
        <p><?php echo Cities::getCity($model->tour->city_from_id) ?></p>
        <p><?php echo $model->tour->date_from ?></p>
    </div>
    <div class="tour-capacity">
        <?php if(!$model->tour->count_kids){ ?>
            <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class=""></i></p>
            <p>взрослыe - <?php echo $model->tour->count_old ?> </p>
        <?php }else{ ?>
            <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-child"></i></p>
            <p>взрослыe - <?php echo $model->tour->count_old ?><span> дети - <?php echo $model->tour->count_kids ?></span></p>
        <?php }?>

    </div>
    <div class="tour-price">
        <?php if($model->tour->hot){ ?>
            <div class="tour-hot visible">горящий тур</div>
        <?php } ?>
        <p><?php echo $model->tour->price ?><span>rub.</span></p>
        <?php if(!user()->id){ ?>
            <div>
                <a href="#" class="login"><div class="tour-compare plus"></div></a>
                <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
            </div>
        <?php }else{ ?>
            <?php if(\frontend\modules\tours\Module::getFavorits($model->tour->id)){ ?>
                <div>
                    <a href="/tours/favorits?save=0&tour_id=<?php echo $model->tour->id ?>" class="ajax-link"><div class="tour-compare minus"></div></a>
                    <div class="tour-like"><a href="/tours/favorits?save=0&tour_id=<?php echo $model->tour->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                </div>
            <?php }else{ ?>
                <div>
                    <a href="/tours/favorits?save=1&tour_id=<?php echo $model->tour->id ?>" class="ajax-link"><div class="tour-compare plus"></div></a>
                    <div class="tour-like"><a href="/tours/favorits?save=1&tour_id=<?php echo $model->tour->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                </div>
            <?php } ?>
        <?php } ?>

        <!-- <span class="tour-comparison-popup">
             <span>2 тура в сравнении</span>
             <div><a href="#"><i class="fa fa-trash"></i></a></div>
         </span>-->
    </div>
</li>
