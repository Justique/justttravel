<?php
use common\models\ReviewsVotes;

?>
<div class="wrapper-inner">
    <div class="head-symbol"><i class="fa fa-star"></i></div>
    <h1>Мои отзывы</h1>
<!--    <a href="#" class="button yellow report-trigger">оставить отзыв</a>-->
    <div class="container company-reports">
        <?php if($model){  ?>
            <?php foreach($model as $item){ ?>
                <div class="report">
                    <span class="report-section"><?php echo $item->tourfirm->name  ?></span>
                    <?php if(!$item->status){ ?>
                        <span class="for-moderation">ожидает модерации</span>
                    <?php } ?>
                    <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews(\common\models\Tourfirms::getPercentVotes($item->id)) ?>"><?php echo \common\models\Tourfirms::getPercentVotes($item->id)?></span>
                    <div class="box">
                        <span class="datemark"><?php echo rus_date('d F Y', $item->date_create) ?></span>
                        <p><?php echo substr($item->comment, 0, 255).". . ." ?></p>
                        <div class="actions">
                            <a href="/tourfirm/<?php echo $item->tourfirm->slug ?>/reviewcomments?tourfirm_id=<?php echo $item->tourfirm_id ?>&reviews_id=<?php echo $item->id ?>">Подробнее</a>
                            <div class="likes">
                                    <a href="/tourfirms/savevotes?reviews_id=<?php echo $item->id ?>&user_id=<?php echo user()->id ?>&vote=1" class="like ajax-link"><i class="fa fa-thumbs-up"></i><?php echo ReviewsVotes::getCountVotes(1, $item->id) ?></a>
                                    <a href="/tourfirms/savevotes?reviews_id=<?php echo $item->id ?>&user_id=<?php echo user()->id ?>&vote=0" class="unlike ajax-link"><i class="fa fa-thumbs-down"></i><?php echo ReviewsVotes::getCountVotes(0, $item->id) ?></a>
                            </div>
                            <p><i class="fa fa-user"></i>Автор отзыва: <a href="#"><?php echo $item->user->firstname  ?></a></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>