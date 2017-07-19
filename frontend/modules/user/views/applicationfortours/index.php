<?php


use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ApplicationForToursSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Application For Tours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="application-for-tours-index">

    <div class="head-symbol"><i class="fa fa-commenting"></i></div>
    <h1>Заявки на туры</h1>
    <ul class="tours-list tour_orders_list">
        <?php foreach($dataProvider->getModels() as $item){ ?>
        <li>
            <div class="tour-name">
                <a href="/profile/messages?messager_id=<?php echo $item->user_id ?>" class="blue"><?php echo $item->user->username ?></a>
                <div class="tour-rate"></div>
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
                <a href=""><?php echo $item->city ? $item->city->city : '' ?></a>
            </div>
            <div class="tour-duration">
                <i class="fa fa-clock-o"></i>
                <p><?php echo $item->nights ?> ночей</p>
                <p><?php echo $item->days ?> дней</p>
            </div>
            <div class="tour-transport">
                <i class="fa fa-calendar-check-o"></i>
                <p><?php echo $item->shoppingCity ? $item->shoppingCity->city : '' ?></p>
                <p><?php echo $item->date ?></p>
            </div>
            <div class="tour-price">
                <p>до <?php echo $item->price ?><span> руб.</span></p>
            </div>
            <a href="#" class="orders_form_trigger"><?php echo \common\models\ApplicationForTours::find()->where(['user_application_id'=>$item->id,'tourfirm_id'=>\common\models\Tourfirms::getTourfirmId(user()->id)])->one() ? "обновить" : "предложить" ?></a>
        </li>
         <li class="form container">
                <?php echo \frontend\modules\user\widgets\applicationfortours\Applicationfortours::widget(['user_application_id'=>$item->id,'tourfirm_id'=>\common\models\Tourfirms::getTourfirmId(user()->id)]) ?>
        </li>
        <?php } ?>
    </ul>
    <?php echo LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
    ?>

</div>
