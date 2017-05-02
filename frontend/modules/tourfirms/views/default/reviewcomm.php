<?php
use common\models\ReviewsVotes;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>
<style>
    .img_button_upload3{
        display:none!important;
    }
</style>
<script>
    $(document).ready(function(){
        $('#load2').click(function() {
            $('.img_button_upload3 .upload-kit-item .remove').click();
            $('#w1').click();
        });
    });
</script>
<section class="company-page with-rating">
    <div class="content-wrapper">
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmHeaderWidget::widget(['model'=>$model]) ?>
        <div class="company-reports company-report-full">
            <div class="report">
                <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews(\common\models\Tourfirms::getPercentVotes($reviews->id)) ?>"><?php echo \common\models\Tourfirms::getPercentVotes($reviews->id)?></span>
                <div class="box">
                    <span class="datemark"><?php echo rus_date('d F Y', $reviews->date_create) ?></span>
                    <p><?php echo $reviews->comment ?></p>
                    <div class="report-photos">
                        <?php
                        $path = Yii::$app->glide->createSignedUrl(['glide/index', 'path' => $reviews->thumbnail_path, 'w' => 100], true);
                        if (checkRemoteFile($path) == false) {
                            echo '';
                        } else {
                            echo Html::img(
                                Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $reviews->thumbnail_path,
                                    'w' => 100,
                                    'q' => getenv('IMAGE_QUALITY')
                                ], true)

                            );
                        }
                        ?>
                    </div>
                    <div class="actions">
                        <?php if(!user()->id){ ?>
                            <a href="#" class="like login"><i class="fa fa-thumbs-up"></i><?php echo ReviewsVotes::getCountVotes(1, $reviews->id) ?></a>
                            <a href="#" class="unlike login"><i class="fa fa-thumbs-down"></i><?php echo ReviewsVotes::getCountVotes(0, $reviews->id) ?></a>
                        <?php }else{ ?>
                            <a href="/tourfirms/savevotes?reviews_id=<?php echo $reviews->id ?>&user_id=<?php echo user()->id ?>&vote=1" class="like ajax-link"><i class="fa fa-thumbs-up"></i><?php echo ReviewsVotes::getCountVotes(1, $reviews->id) ?></a>
                            <a href="/tourfirms/savevotes?reviews_id=<?php echo $reviews->id ?>&user_id=<?php echo user()->id ?>&vote=0" class="unlike ajax-link"><i class="fa fa-thumbs-down"></i><?php echo ReviewsVotes::getCountVotes(0, $reviews->id) ?></a>
                        <?php } ?>
                        <p><i class="fa fa-user"></i>Автор отзыва: <a href="/profile/messages?messager_id=<?php echo $reviews->user_id ?>"><?php echo $reviews->user->firstname  ?></a></p>
                    </div>
                </div>
            </div>
            <?php if($reviews->comments) { ?>
                <h1>Комментарии к отзыву</h1>
            <?php }else{ ?>
                <h1>Комментарии к отзыву отсутсвуют</h1>
            <?php } ?>
            <?php foreach($reviews->comments as $comment){ ?>
                <div class="report-comment">
                    <div>
                        <p>
                            <?php echo $comment->comment ?>
                        </p>
                        <p>
                            <?php
                            $path = Yii::$app->glide->createSignedUrl(['glide/index', 'path' => $comment->thumbnail_path, 'w' => 100], true);
                            if (checkRemoteFile($path) == false) {
                                echo '';
                            } else {
                                echo Html::img(
                                    Yii::$app->glide->createSignedUrl([
                                        'glide/index',
                                        'path' => $comment->thumbnail_path,
                                        'w' => 100,
                                        'q' => getenv('IMAGE_QUALITY')
                                    ], true)

                                );
                            }
                            ?>
                        </p>
                    </div>
                    <p>
                        <a href="#"><?php echo $comment->user->username ?></a><span> </span><span class="comment-datemark"><?php echo rus_date('d F Y', $comment->date_create) ?></span>
                    </p>

                </div>
            <?php } ?>
            <h1>Оставить комментарий</h1>
            <?php
            $form = ActiveForm::begin(['action'=>'/tourfirms/savereviewcomments','id'=>'report-leave-comment','options'=>['class'=>'ajax-form']]);
            $model = new \common\models\ReviewsComment();
            echo $form->field($model, 'comment')->textarea(['cols'=>'30', 'rows'=>'10', 'placeholder'=>'Ваш комментарий...'])->label(false);
            echo $form->field($model, 'user_id')->hiddenInput(['value'=>user()->id])->label(false);
            echo $form->field($model, 'reviews_id')->hiddenInput(['value'=>$reviews->id])->label(false);
            echo $form->field($model, 'date_create')->hiddenInput(['value'=>time()])->label(false);
            ?>
            <div class="button-line">
                <?php
                echo Html::Button('<i class="fa fa-picture-o"></i>Изображение',['class'=>'button yellow', 'id'=>'load2']);
                ?>
                <div class="img_button_upload3">
                    <?php
                     echo $form->field($model, 'thumbnail')->widget(
                        \trntv\filekit\widget\Upload::className(),
                        [
                            'url' => ['/file-storage/upload'],
                            'maxFileSize' => 5000000, // 5 MiB
                        ]);
                    ?>
                </div>
                    <?php echo Html::submitButton('отправить комментарий',['class'=>'button yellow']); ?>
            </div>
            <?php
            ActiveForm::end();
            ?>
        </div>
    </div>
</section>