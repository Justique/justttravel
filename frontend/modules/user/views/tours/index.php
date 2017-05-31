<?php

use common\models\Cities;
use common\models\Countries;
use yii\grid\GridView;
use yii\helpers\Html;
use frontend\modules\user\Module;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\ToursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $canCreate boolean */
/* @var $canUp boolean */

$this->title = 'Туры Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-user">
<div class="head-symbol"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
<h1><?= Html::encode($this->title) ?></h1>
<?php if($flagTourfirm){ ?>
    <?php if ($canCreate): ?>
        <p>
            <?= Html::a('Добавить тур', ['create'], ['class' => 'button yellow button_main']) ?>
        </p>
    <?php endif; ?>
    <ul class="tours-list tour_orders_list company_tours">
        <?php if(!empty($model)){ ?>
        <?php foreach($dataProvider->getModels() as $item){ ?>
            <li class="">
                <div class="tour-name">
                    <a href="/tour/<?php echo $item->slug ?>" class="blue"><?php echo $item->title ?></a>
                    <div class="tour-rate">
                        <div class="lime-orange rating-grade">3.80</div>
                        <a href="">рейтинг фирмы</a>
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
                    <a href="" class="blue"><?php echo Countries::getCountry($item->country_to_id) ?></a>
                    <a href=""><?php echo Cities::getCity($item->city_to_id) ?></a>
                </div>
                <div class="tour-duration">
                    <p><?php echo $item->count_nights ?> ночей</p>
                    <p><?php echo $item->count_days ?>  дней</p>
                </div>
                <div class="tour-transport">
                    <i class="fa fa-calendar-check-o"></i>
                    <p><?php echo Cities::getCity($item->city_from_id) ?></p>
                    <p><?php echo $item->date_from ?></p>
                </div>
                <div class="tour-price">
                    <p><?php echo $item->price ?><span>руб.</span></p>
                </div>
                <div class="bottom_buttons">
                    <?php if ($canUp): ?>
                        <?= Html::a('апнуть', ['up', 'id' => $item->id], ['data-method' => 'POST', 'class' => 'up_trigger']) ?>
                    <?php endif; ?>
                    <a href="#" class="orders_form_trigger expand">Изменить</a>
                </div>
            </li>
            <li class="form container">
                <?php echo \frontend\modules\user\widgets\tours\Tours::widget(['tour_id'=>$item->id ]) ?>
            </li>
            <?php } ?>
        <?php } ?>
    </ul>
    <?php echo \yii\widgets\LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
    ?>
</div>
<?php }else{ ?>
    <p>
        Турфирма еще не создана!
    </p>
<?php } ?>