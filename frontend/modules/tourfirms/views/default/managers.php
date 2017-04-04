<section class="company-page with-rating">
<div class="content-wrapper">
<?php if(isset($model[0])){ ?>
    <?php echo \frontend\modules\tourfirms\widgets\TourfirmHeaderWidget::widget(['model'=>$model[0]->tourfirm]) ?>
    <div class="company-managers">
        <?php foreach($model as $manager){ ?>
            <?php if($manager->profileManager){?>
            <div class="manager">
                <div>
                    <a href="/profile/messages?messager_id=<?php echo $manager->profileManager->user_id ?>">
                        <i class="fa fa-commenting-o"></i>
                        <?php
                        echo \yii\helpers\Html::img(
                            Yii::$app->glide->createSignedUrl([
                                'glide/index',
                                'path' => $manager->profileManager->avatar_path,
                                'w' => 200
                            ], true)
                        );
                        ?>
                    </a>
                </div>
                <ul class="manager-contact">
                    <?php if($manager->managerPhones){ ?>
                            <?php if(isset($manager->managerPhones->default)){ ?><li class="contact-phone"><?php echo $manager->managerPhones->default ?></li><?php }?>
                            <?php if(isset($manager->managerPhones->life)){?><li class="contact-life"><?php echo $manager->managerPhones->life ?></li><?php }?>
                            <?php if(isset($manager->managerPhones->mts)){?><li class="contact-mts"><?php echo $manager->managerPhones->mts ?></li><?php }?>
                            <?php if(isset($manager->managerPhones->viber)){?><li class="contact-viber"><?php echo $manager->managerPhones->viber ?></li><?php }?>
                            <?php if(isset($manager->managerPhones->skype)){?><li class="contact-skype"><?php echo $manager->managerPhones->skype ?></li><?php }?>
                            <?php if(isset($manager->managerPhones->icq)){?><li class="contact-icq"><?php echo $manager->managerPhones->icq ?></li><?php }?>
                    <?php } ?>
                </ul>
                <p><?php echo $manager->profileManager->firstname ?></p>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php }else{
        echo \frontend\modules\tourfirms\widgets\TourfirmHeaderWidget::widget(['model'=>$model]); ?>
        <h3>Менеждеров нету</h3>

    <?php } ?>

</div>
    </section>