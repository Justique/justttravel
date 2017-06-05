<?php
use yii\helpers\Html;
?>
<section class="company-page with-rating">
    <div class="content-wrapper">
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmHeaderWidget::widget(['model'=>$model]) ?>
        <div class="company-desc">
            <div class="desc-head">
                <div class="company-logo-group">
                    <div>
                        <?php if ($model->tourfirmAttachments ): ?>
                            <?= \yii\helpers\Html::img(
                                Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $model->tourfirmAttachments[0]->path,
                                    'w' => 250,
                                    'q' => getenv('IMAGE_QUALITY')
                                ], true)
                            ) ?>
                        <?php endif; ?>
                        <?php if ($model->tourfirmWorkTime): ?>
                            <div class="timing">
                                <h3><i class="fa fa-clock-o"></i>Время работы</h3>
                                <ul>
                                    <li>понедельник: <?php echo $model->tourfirmWorkTime->monday ?></li>
                                    <li>вторник: <?php echo $model->tourfirmWorkTime->tuesday ?></li>
                                    <li>среда: <?php echo $model->tourfirmWorkTime->wednesday ?></li>
                                    <li>четверг: <?php echo $model->tourfirmWorkTime->thursday ?></li>
                                    <li>пятница: <?php echo $model->tourfirmWorkTime->friday ?></li>
                                    <li>суббота: <?php echo $model->tourfirmWorkTime->saturday ?></li>
                                    <li>воскресенье: <?php echo $model->tourfirmWorkTime->sunday ?></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="info">
                    <h3><i class="fa fa-folder"></i>Юридическая информация</h3>
                    <p><?php echo $model->legal_info ?></p>
                </div>
                <div class="contact">
                    <h3><i class="fa fa-map-marker"></i>Контакты</h3>
                    <a href="/tourfirm/<?php echo $model->slug?>/contact#address-contact"><?php echo $model->address ?></a>
                    <ul>
                        <?php if(isset($model->tourfirmsPhon->default)){?><li class="contact-phone"><?php echo $model->tourfirmsPhon->default ?></li><?php } ?>
                        <?php if(isset($model->tourfirmsPhon->life)){?><li class="contact-life"><?php echo $model->tourfirmsPhon->life ?></li><?php } ?>
                        <?php if(isset($model->tourfirmsPhon->mts)){?><li class="contact-mts"><?php echo $model->tourfirmsPhon->mts ?></li><?php } ?>
                        <?php if(isset($model->tourfirmsPhon->velcom)){?><li class="contact-viber"><?php echo $model->tourfirmsPhon->velcom ?></li><?php } ?>
                        <?php if(isset($model->tourfirmsPhon->skype)){?><li class="contact-skype"><?php echo $model->tourfirmsPhon->skype ?></li><?php } ?>
                        <?php if(isset($model->tourfirmsPhon->icq)){?><li class="contact-icq"><?php echo $model->tourfirmsPhon->icq ?></li><?php } ?>
                    </ul>
                </div>
            </div>
            <div class="company-desc-text">
                <h5><?php echo $model->name ?></h5>
                <p class="m-l-none"><?php echo $model->description ?></p>
            </div>
            <?php if ($model->tourfirmAttachments ): ?>
                <div class="company-images">
                    <?php foreach ($model->tourfirmAttachments as $img): ?>
                        <?= Html::a(
                            Html::img(Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $img->path,
                                    'w' => 255,
                                    'h' => 255,
                                    'fit' => 'crop',
                                    'q' => getenv('IMAGE_QUALITY')
                                ], true)
                            ),
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $img->path
                            ], true),
                            ['data-lightbox' => 'img-' . $img->id])
                        ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
