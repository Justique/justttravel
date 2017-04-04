<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\VisaOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы виз';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visa-order-index">
    <div class="head-symbol"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <ul class="tours-list tour_orders_list">
        <?php foreach($dataProvider->getModels() as $item){ ?>
            <li>
                <div class="visa-name" disabled>
                    <a href="/visa/<?php echo $item->visa->slug ?>" class="blue"><?php echo $item->visa->name ?></a>
                    <div class="tour-rate">
                        <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews((float)$item->visa->tourfirm->rating) ?>"><?php echo (float)$item->visa->tourfirm->rating ?></span>
                        <?php if(user()->id){ ?>
                            <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $item->visa->tourfirm_id ?>">рейтинг фирмы</a>
                        <?php }else{ ?>
                            <a class="login" href="#">рейтинг фирмы</a>
                        <?php } ?>
                    </div>
                    <p><?php echo convertDate($item->visa->date_update) ?></p>
                </div>
                <div class="visa-destination">
                    <a href="/visa?VisaSearch[country_id]=<?php echo $item->visa->country_id ?>" class="blue"><?php echo \common\models\Countries::getCountry($item->visa->country_id); ?></a>
                    <a href="/visa?VisaSearch[city_id]=<?php echo $item->visa->city_id ?>"><?php echo \common\models\Cities::getCity($item->visa->city_id); ?></a>
                </div>
                <div class="visa-type">
                    <p><?php echo $item->visa->type ?></p>
                    <p><?php echo $item->visa->type_time ?></p>
                </div>
                <div class="visa-desc">
                    <p class="req-time"><i class="fa fa-clock-o"></i>Срок оформления: <strong><?php echo $item->visa->period; ?> дней</strong></p>
                    <p class="req-docs"><i class="fa fa-folder-o"></i>Документы: <?php echo $item->visa->documents; ?>...</p>
                </div>
                <div class="tour-price">
                    <p><?php echo $item->visa->price; ?> <span>руб.</span></p>
                </div>

                <a href="#" class="orders_form_trigger">контакты</a>
                <a href="/user/visaorder/delete?id=<?php echo $item->id ?>" title="Удалить" aria-label="Удалить" data-pjax="0" data-method="post" data-confirm="Вы уверены, что хотите удалить этот элемент?" class="delete">удалить</a>
            </li>
            <li class="form container contacts">
                <h2>Контакты</h2>
                <div class="fields">
                    <input type="text" name="" id="" value="<?php echo $item->user->lastname." ".$item->user->firstname." ".$item->user->middlename ?>">
                    <input type="text" name="" id="" value="<?php echo $item->email?>">
                </div>
                <!--            <textarea name="" id="" cols="30" rows="10">Трали вали</textarea>-->
            </li>
        <?php } ?>
    </ul>
</div>
