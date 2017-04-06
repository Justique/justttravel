<?php
use yii\helpers\Html;
?>
<script>
   function locationRe(id){
        window.location.href = '/user/visa/update?id='+id;
    }
</script>
<li class="tours-list tour_orders_list">
<div class="visa-name" disabled>
    <a href="" class="blue"><?php echo $model->name ?></a>
    <div class="tour-rate">
        <div class="green rating-grade">5.00</div>
        <a href="">рейтинг фирмы</a>
    </div>
    <p>добавлен <?php echo $model->date_update ?> минут назад</p>
</div>
<div class="visa-destination">
    <a href="" class="blue"><?php echo \common\models\Countries::getCountry($model->country_id); ?></a>
    <a href=""><?php echo \common\models\Cities::getCity($model->city_id); ?></a>
</div>
<div class="visa-type">
    <p><?php echo $model->description ?></p>
    <p>Многократная</p>
</div>
<div class="visa-desc">
    <p class="req-time"><i class="fa fa-clock-o"></i>Срок оформления: <strong><?php echo $model->period; ?> дней</strong></p>
    <p class="req-docs"><i class="fa fa-folder-o"></i>Документы: <?php echo $model->documents; ?>...</p>
</div>
<div class="tour-price">
    <p><?php echo $model->price; ?> <span>руб.</span></p>
</div>
    <?= Html::a('апнуть', ['up', 'id' => $model->id], [
        'data-method' => 'POST',
        'class' => 'orders_form_trigger',
        'style' => 'margin-right: 230px;'
    ]) ?>
    <a onclick="locationRe(<?php echo $model->id ?>)" href="#" class="orders_form_trigger">Изменить</a>
</li>
<!--<li class="form container">-->
<!--    --><?php //echo \frontend\modules\user\widgets\visa\Visa::widget(['visa_id'=>$model->id ]) ?>
<!--</li>-->