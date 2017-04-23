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
                                    'w' => 250
                                ], true)
                            ) ?>
                        <?php endif; ?>
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
                        <?php if(isset($model->tourfirmsPhon->viber)){?><li class="contact-viber"><?php echo $model->tourfirmsPhon->viber ?></li><?php } ?>
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
                        <?= \yii\helpers\Html::img(
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $img->path,
                                'w' => 200
                            ], true)
                        ) ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
