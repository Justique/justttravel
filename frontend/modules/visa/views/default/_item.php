<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 22.02.2016
 * Time: 14:32
 */
?>
<li  class="green">
<div class="visa-name" disabled>
    <a href="/visa/<?php echo $model->slug ?>" class="blue"><?php echo $model->name ?></a>
    <div class="tour-rate">
        <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews($model->tourfirm->rating) ?>"><?php echo (float)$model->tourfirm->rating ?></span>
        <?php if(user()->id){ ?>
            <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $model->tourfirm_id ?>">рейтинг фирмы</a>
        <?php }else{ ?>
            <a class="login" href="#">рейтинг фирмы</a>
        <?php } ?>
    </div>
    <p><?php echo convertDate($model->date_update) ?></p>
</div>
<div class="visa-destination">
    <a href="/visa?VisaSearch[country_id]=<?php echo $model->country_id ?>" class="blue"><?php echo \common\models\Countries::getCountry($model->country_id); ?></a>
    <a href="/visa?VisaSearch[city_id]=<?php echo $model->city_id ?>"><?php echo \common\models\Cities::getCity($model->city_id); ?></a>
</div>
<div class="visa-type">
    <p><?php echo $model->type ?></p>
    <p><?php echo $model->type_time ?></p>
</div>
<div class="visa-desc">
    <p class="req-time"><i class="fa fa-clock-o"></i>Срок оформления: <strong><?php echo $model->period; ?> дней</strong></p>
    <p class="req-docs"><i class="fa fa-folder-o"></i>Документы: <?php echo $model->documents; ?>...</p>
</div>
<div class="tour-price">
    <p><?php echo $model->price; ?> <span>руб.</span></p>
    <?php if(!user()->id){ ?>
        <div>
            <a href="#" class="login"><div class="tour-compare plus"></div></a>
            <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
        </div>
    <?php }else{ ?>
        <div>
            <a href="/visa/comparison?comparison_save=1&visa_id=<?php echo $model->id ?>&tourfirm_id=<?php echo $model->tourfirm_id ?>"class="ajax-link"><div class="tour-compare plus"></div></a>
            <?php if(\frontend\modules\visa\Module::getFavorits($model->id)){ ?>
                <div class="tour-like"><a href="/visa/favorits?save=0&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
            <?php }else{?>
                <div class="tour-like"><a href="/visa/favorits?save=1&visa_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if($countComp = \frontend\modules\visa\Module::getComparison($model->id)){ ?>
        <span class="tour-comparison-popup" style="display: block" >
                    <a href="/comparison/visa"><span><?php echo $countComp ?></span></a>
                    <div><a href="/visa/comparison?comparison_save=0&visa_id=<?php echo $model->id ?>" class="ajax-link"><i class="fa fa-trash"></i></a></div>
        </span>
    <?php } ?>
</div>

</li>