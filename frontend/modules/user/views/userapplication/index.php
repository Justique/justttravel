<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserApplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-application-index">
    <div class="head-symbol"><i class="fa fa-commenting"></i></div>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать заявку', ['create'], ['class' => 'button yellow button_main']) ?>
    </p>
    <ul class="tours-list tour_orders_list">
        <?php foreach($dataProvider->getModels() as $item){ ?>
            <li>
                <div class="tour-name">
                    <a href="" class="blue"><?php echo $item->user->username ?></a>
                    <div class="tour-rate">

                    </div>
                    <p>добавлен <?php echo convertDate($item->date_update)?></p>
                </div>
                <div class="general">
                    <?php if($item->transport_type) { ?>
                        <div class="tour-type"><i class="fa fa-<?php echo $item->transport->class ?>"></i><span><?php echo $item->transport->about ?></span></div>
                    <?php } ?>
                    <?php echo \frontend\modules\user\Module::getCountPeoples($item->childrens, $item->adults) ?>
                </div>
                <div class="tour-destination">
                    <i class="fa fa-map-marker"></i>
                    <a href="" class="blue"><?php echo $item->country->name ?></a>
                    <a href=""><?php echo $item->city->city ?></a>
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
                    <p><?php echo $item->nights ?> ночей</p>
                    <p><?php echo $item->days ?> дней</p>
                </div>
                <div class="tour-transport">
                    <i class="fa fa-calendar-check-o"></i>
                    <p><?php echo $item->shoppingCity->city ?></p>
                    <p><?php echo $item->date ?></p>
                </div>
                <div class="tour-price">
                    <p>до <?php echo $item->price ?><span> руб.</span></p>
                </div>
                <a href="#"  onclick="window.location = '/user/userapplication/update?id=<?php echo $item->id ?>'" class="orders_form_trigger location">Отклики</a>
            </li>

            <li class="form container">
<!--                --><?php //echo \frontend\modules\user\widgets\userapplication\Userapplication::widget(['id_application'=>$item->id]) ?>
            </li>
        <?php } ?>
    </ul>
</div>
