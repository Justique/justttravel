<?php

use common\models\Cities;
use common\models\Countries;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\ToursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Туры Компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-user">
<div class="head-symbol"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
<h1><?= Html::encode($this->title) ?></h1>
<?php if($flagTourfirm){ ?>
    <p>
        <?= Html::a('Добавить тур', ['create'], ['class' => 'button yellow button_main']) ?>
    </p>
<div style="display: none">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'price',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
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
                <div class="tour-destination">
                    <a href="" class="blue"><?php echo Countries::getCountry($item->country_to_id) ?></a>
                    <a href=""><?php echo Cities::getCity($item->city_to_id) ?></a>
                </div>
                <div class="tour-duration">
                    <p><?php echo $item->count_nights ?> ночей</p>
                    <p><?php echo $item->count_days ?>  дней</p>
                </div>
                <div class="tour-transport">
                    <i class="fa fa-<?php echo $item->transport->class ?>"></i>
                    <p><?php echo Cities::getCity($item->city_from_id) ?></p>
                    <p><?php echo $item->date_from ?></p>
                </div>
                <div class="tour-capacity">
                    <?php if(!$item->count_kids){ ?>
                        <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class=""></i></p>
                        <p>взрослыe - <?php echo $item->count_old ?> </p>
                    <?php }else{ ?>
                        <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-child"></i></p>
                        <p>взрослыe - <?php echo $item->count_old ?><span> дети - <?php echo $item->count_kids ?></span></p>
                    <?php }?>
                </div>
                <div class="tour-price">
                    <?php if($item->hot){ ?>
                        <div class="tour-hot visible">горящий тур</div>
                    <?php } ?>
                    <p><?php echo $item->price ?><span>rub.</span></p>
                </div>
                <div class="bottom_buttons">
                    <a href="#" class="up_trigger">апнуть</a>
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