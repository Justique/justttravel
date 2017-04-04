<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 22.02.2016
 * Time: 14:32
 */
?>
<li>
<div class="visa-name" disabled>
    <a href="/visa/<?php echo $model->visa->slug ?>" class="blue"><?php echo $model->visa->name ?></a>
    <div class="tour-rate">
        <div class="green rating-grade">5.00</div>
        <a href="">рейтинг фирмы</a>
    </div>
    <p><?php echo convertDate($model->visa->date_update) ?></p>
</div>
<div class="visa-destination">
    <a href="/visa?VisaSearch[country_id]=<?php echo $model->visa->country_id ?>" class="blue"><?php echo \common\models\Countries::getCountry($model->visa->country_id); ?></a>
    <a href="/visa?VisaSearch[city_id]=<?php echo $model->visa->city_id ?>"><?php echo \common\models\Cities::getCity($model->visa->city_id); ?></a>
</div>
<div class="visa-type">
    <p><?php echo $model->visa->type ?></p>
    <p><?php echo $model->visa->type_time ?></p>
</div>
<div class="visa-desc">
    <p class="req-time"><i class="fa fa-clock-o"></i>Срок оформления: <strong><?php echo $model->visa->period; ?> дней</strong></p>
    <p class="req-docs"><i class="fa fa-folder-o"></i>Документы: <?php echo $model->visa->documents; ?>...</p>
</div>
<div class="tour-price">
    <p><?php echo $model->visa->price; ?> <span>руб.</span></p>
    <?php if(!user()->id){ ?>
        <div>
            <a href="#" class="login"><div class="tour-compare plus"></div></a>
            <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
        </div>
    <?php }else{ ?>
        <?php if(\frontend\modules\visa\Module::getFavorits($model->visa->id)){ ?>
            <div>
                <a href="/visa/favorits?save=0&visa_id=<?php echo $model->visa->id ?>" class="ajax-link"><div class="tour-compare minus"></div></a>
                <div class="tour-like"><a href="tours/favorits?save=0&tour_id=<?php echo $model->visa->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
            </div>
        <?php }else{ ?>
            <div>
                <a href="/visa/favorits?save=1&visa_id=<?php echo $model->visa->id ?>" class="ajax-link"><div class="tour-compare plus"></div></a>
                <div class="tour-like"><a href="visa/favorits?save=1&tour_id=<?php echo $model->visa->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
            </div>
        <?php } ?>
    <?php } ?>
</div>

</li>