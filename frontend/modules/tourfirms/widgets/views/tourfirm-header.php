<h1>
    <?php echo $model->name ?>
    <div>
        <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews((float)$model->rating) ?>"><?php echo (float)$model->rating ?></span>
        <?php if(user()->id){ ?>
            <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $model->id ?>">рейтинг фирмы</a>
        <?php }else{ ?>
            <a class="login" href="#">рейтинг фирмы</a>
        <?php } ?>
    </div>
</h1>
<?php echo \frontend\modules\tourfirms\widgets\TourfirmReviewsWidget::widget(['id'=>$model->id, 'slug'=>$model->slug]) ?>
<ul class="tabs-container">
    <li <?php echo \frontend\modules\tourfirms\Module::getActiveClass(yii\helpers\Url::to(''), 'info') ?>><a href="/tourfirm/<?php echo $model->slug ?>/info">описание</a></li>
    <li <?php echo \frontend\modules\tourfirms\Module::getActiveClass(yii\helpers\Url::to(''), 'reviews') ?>><a href="/tourfirm/<?php echo $model->slug ?>/reviews">отзывы</a></li>
    <li <?php echo \frontend\modules\tourfirms\Module::getActiveClass(yii\helpers\Url::to(''), 'contact') ?>><a href="/tourfirm/<?php echo $model->slug ?>/contact">контакты</a></li>
    <li <?php echo \frontend\modules\tourfirms\Module::getActiveClass(yii\helpers\Url::to(''), 'article') ?>><a href="/tourfirm/<?php echo $model->slug ?>/article">новости/акции</a></li>
    <li <?php echo \frontend\modules\tourfirms\Module::getActiveClass(yii\helpers\Url::to(''), 'managers') ?>><a href="/tourfirm/<?php echo $model->slug ?>/managers?id=<?php echo $model->touroperator_id ?>">менеджеры</a></li>
    <li <?php echo \frontend\modules\tourfirms\Module::getActiveClass(yii\helpers\Url::to(''), 'tours') ?> ><a href="/tourfirm/<?php echo $model->slug ?>/tours">туры <?php echo "(".count($model->tours).")" ?></a></li>
</ul>