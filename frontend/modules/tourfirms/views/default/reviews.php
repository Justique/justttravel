<?php
use common\models\ReviewsVotes;

?>
<section class="company-page with-rating">
    <div class="content-wrapper">
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmHeaderWidget::widget(['model'=>$model]) ?>
        <div class="company-reports">
         <?php if($reviews){  ?>
            <?php foreach($reviews as $item){ ?>
                 <?php if($item->status == 1) {?>
                    <div class="report">
                        <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews(\common\models\Tourfirms::getPercentVotes($item->id)) ?>"><?php echo \common\models\Tourfirms::getPercentVotes($item->id)?></span>
                        <div class="box">
                            <span class="datemark"><?php echo rus_date('d F Y', $item->date_create) ?></span>
                            <p><?php echo substr($item->comment, 0, 255).". . ." ?></p>
                            <div class="actions">
                                <a href="reviewcomments?tourfirm_id=<?php echo $item->tourfirm_id ?>&reviews_id=<?php echo $item->id ?>">Подробнее</a>
                                <div class="likes">
                                    <?php if(!user()->id){ ?>
                                        <a href="#" class="like login"><i class="fa fa-thumbs-up"></i><?php echo ReviewsVotes::getCountVotes(1, $item->id) ?></a>
                                        <a href="#" class="unlike login"><i class="fa fa-thumbs-down"></i><?php echo ReviewsVotes::getCountVotes(0, $item->id) ?></a>
                                    <?php }else{ ?>
                                        <a href="/tourfirms/savevotes?reviews_id=<?php echo $item->id ?>&user_id=<?php echo user()->id ?>&vote=1" class="like ajax-link"><i class="fa fa-thumbs-up"></i><?php echo ReviewsVotes::getCountVotes(1, $item->id) ?></a>
                                        <a href="/tourfirms/savevotes?reviews_id=<?php echo $item->id ?>&user_id=<?php echo user()->id ?>&vote=0" class="unlike ajax-link"><i class="fa fa-thumbs-down"></i><?php echo ReviewsVotes::getCountVotes(0, $item->id) ?></a>
                                    <?php } ?>
                                </div>
                                <p><i class="fa fa-user"></i>Автор отзыва: <a href="/profile/messages?messager_id=<?php echo $item->user_id ?>"><?php echo $item->user->firstname  ?></a></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
        </div>
    </div>
</section>