<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ToursOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы туров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tours-order-index">
    <div class="head-symbol"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
    <h1><?= Html::encode($this->title) ?></h1><br><br><br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <ul class="tours-list tour_orders_list">
        <?php foreach($dataProvider->getModels() as $item){ ?>
        <li>
            <div class="tour-name">
                <a href="/profile/messages?messager_id=<?php echo $item->user->user_id ?>" class="blue"><?php echo $item->user->firstname." ".$item->user->lastname ?></a>
                <div class="tour-rate">

                </div>
                <p>добавлен <?php echo convertDate($item->created)?></p>
            </div>
            <div class="general">
                <div class="tour-type"><i class="fa fa-ship"></i><span><?php echo $item->tour->transport->type ?></span></div>
                <?php echo \frontend\modules\user\Module::getCountPeoples($item->tour->count_old, $item->tour->count_kids) ?>
                <?php if($item->tour->hot){ ?>
                    <div class="tour-hot visible">горящий тур</div>
                <?php } ?>
            </div>
            <div class="tour-destination">
                <i class="fa fa-map-marker"></i>
                <a href="" class="blue"><?php echo $item->tour->country->name ?></a>
                <a href=""><?php echo $item->tour->city->city ?></a>
            </div>
            <div class="tour-hotel">
                <a href="" class="blue">Любой отель</a>
                <div class="tour-hotel-rate">
                    <div class="rating-grade lime">4.05</div>
                    <a href="">рейтинг Tophotels</a>
                </div>
                <p>BB (только завтрак)</p>
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
            </div>
            <a href="#" class="orders_form_trigger">контакты</a>
<!--            <a href="/user/toursorder/delete?id=<?php echo $item->id ?>" title="Удалить" aria-label="Удалить" data-pjax="0" data-method="post" data-confirm="Вы уверены, что хотите удалить этот элемент?" class="delete">удалить</a> -->
        </li>
        <li class="form container contacts">
            <h2>Контакты</h2>
            <div class="fields">
                <input type="text" name="" id="" value="<?php echo $item->user->lastname." ".$item->user->firstname." ".$item->user->middlename ?>">
                <input type="text" name="" id="" value="<?php echo $item->email?>">
                <?php if($item->tour->count_old){ ?><input type="text" name="" id="" value="Кол-во взрослых - <?php echo $item->tour->count_old ?>"><?php } ?>
                <?php if($item->tour->count_kids){ ?><input type="text" name="" id="" value="Кол-во детей - <?php echo $item->tour->count_kids ?>"><?php } ?>
                <input type="text" name="" id="" value="Примерная дата выезда - <?php echo $item->date?>">
            </div>
<!--            <textarea name="" id="" cols="30" rows="10">Трали вали</textarea>-->
        </li>
        <?php } ?>
    </ul>
</div>
