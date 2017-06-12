<?php
use common\models\Cities;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\MaskedInput;
?>
<section class="tour-full-page">
    <div class="content-wrapper">
        <h1><?php echo $model->country->name ?></h1>
        <p><?php echo $model->city->city ?></p>
        <div class="tour-info">
            <div class="tour-name">
                <a href="" class="blue"><?php echo $model->title ?></a>
                <div class="tour-rate">
                    <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews((float)$model->tourfirm->rating) ?>"><?php echo (float)$model->tourfirm->rating ?></span>
                    <?php if(user()->id){ ?>
                        <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $model->tourfirm_id ?>">рейтинг фирмы</a>
                    <?php }else{ ?>
                        <a class="login" href="#">рейтинг фирмы</a>
                    <?php } ?>
                </div>
                <p>добавлен <?php echo convertDate($model->published_at)?></p>
            </div>
            <div class="tour-duration">
                <p><?php echo $model->count_nights ?> ночей</p>
                <p><?php echo $model->count_days ?>  дней</p>
            </div>
            <div class="tour-transport">
                <i class="fa fa-<?php echo $model->transport->class ?>"></i>
                <p><?php echo Cities::getCity($model->city_from_id) ?></p>
                <p><?php echo $model->date_from ?></p>
            </div>
            <div class="tour-capacity">
                <?php if(!$model->count_kids){ ?>
                    <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class=""></i></p>
                    <p>взрослыe - <?php echo $model->count_old ?> </p>
                <?php }else{ ?>
                    <p><i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-child"></i></p>
                    <p>взрослыe - <?php echo $model->count_old ?><span> дети - <?php echo $model->count_kids ?></span></p>
                <?php }?>
            </div>
            <div class="tour-price">
                <?php  ?>
                <?php if($model->hot){ ?>
                    <div class="tour-hot visible">горящий тур</div>
                <?php } ?>
                <p><?php echo $model->price ?> <span>руб.</span></p>
                <?php if(!user()->id){ ?>
                    <div>
                        <a href="/site/notuser" class="login"><div class="tour-compare plus"></div></a>
                        <div class="tour-like"><a href="/site/notuser" class="login"><div class="heart"></div></a><span></span></div>
                    </div>
                <?php }else{ ?>
                    <?php if(\frontend\modules\tours\Module::getFavorits($model->id)){ ?>
                        <div>
                            <a href="/tours/favorits?save=0&tour_id=<?php echo $model->id ?>" class="ajax-link"><div class="tour-compare minus"></div></a>
                            <div class="tour-like"><a href="/tours/favorits?save=0&tour_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                        </div>
                    <?php }else{ ?>
                        <div>
                            <a href="/tours/favorits?save=1&tour_id=<?php echo $model->id ?>" class="ajax-link"><div class="tour-compare plus"></div></a>
                            <div class="tour-like"><a href="/tours/favorits?save=1&tour_id=<?php echo $model->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
<!--        <div class="company-desc-grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 252, "gutter": 30 }'>-->
        <div class="img-tour-desc">
            <?php if ($model->tourAttachments): ?>
                <?php foreach ($model->tourAttachments as $img): ?>
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
            <?php endif; ?>
        </div>
<!--        </div>-->
        <h1 class="mid-head">Информация о туре</h1>
        <div class="tour-desc-text">
            <p><?php echo $model->body ?></p>
        </div>
        <script type="text/javascript">
         (function() {
                  if (window.pluso)if (typeof window.pluso.start == "function") return;
                  if (window.ifpluso==undefined) { window.ifpluso = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                    var h=d[g]('body')[0];
                    h.appendChild(s);
                    }})();
        </script>
        <div class="pluso" data-background="#ebebeb" data-options="big,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>
        <hr class="medium">
        <div class="tour-options">
            <?php if(!user()->id){ ?>
                <a class="button yellow login" href="/site/notuser">Заказать тур</a>
                <a class="button yellow login" href="/site/notuser">Уточнить информацию</a>
            <?php }else{ ?>
                <a class="button yellow order-trigger" href="#">Заказать тур</a>
                <a class="button yellow" href="/profile/messages?messager_id=<?php echo $model->user_id ?>">Уточнить информацию</a>
            <?php } ?>
        </div>
        <div class="tour-manager">
            <p>Менеджер тура</p>
            <?php echo \yii\helpers\Html::img(
                Yii::$app->glide->createSignedUrl([
                    'glide/index',
                    'path' => $model->profile->avatar_path,
                    'w' => 200,
                    'h' => 200,
                    'q' => getenv('IMAGE_QUALITY')
                ], true)
            ); ?>
            <p><?php echo $model->user->username ?></p>
        </div>
        <ul class="manager-contact">
                <?php if(isset($model->contactManager->default)){?><li class="contact-phone"><?php echo $model->contactManager->default ?></li><?php } ?>
                <?php if(isset($model->contactManager->life)){?><li class="contact-life"><?php echo $model->contactManager->life ?></li><?php } ?>
                <?php if(isset($model->contactManager->mts)){?><li class="contact-mts"><?php echo $model->contactManager->mts ?></li><?php } ?>
                <?php if(isset($model->contactManager->viber)){?><li class="contact-viber"><?php echo $model->contactManager->viber ?></li><?php } ?>
                <?php if(isset($model->contactManager->skype)){?><li class="contact-skype"><?php echo $model->contactManager->skype ?></li><?php } ?>
                <?php if(isset($model->contactManager->icq)){?><li class="contact-icq"><?php echo $model->contactManager->icq ?></li><?php } ?>
        </ul>
        <br style="clear: both;";
    </div>
    <div class="w_popup order_popup">
        <i class="fa fa-times popup_close"></i>
        <div class="popup_head">Заказать тур</div>
        <?php $form = ActiveForm::begin([
            'action'=>'/tour/order',
            'id'=>'order_tour',
            'options' => [
                'class' => 'ajax-form'
            ]]);
        ?>
            <?php $modelOrder = new \common\models\ToursOrder() ?>

            <?= $form->field($modelOrder, 'name')->textInput(['type'=>'text','placeholder'=>'Ваше имя'])->label(false) ?>

            <?php if(user()->id){
                $email = \common\models\User::getEmail(user()->id);
            } else $email ='' ?>

            <?= $form->field($modelOrder, 'email')->textInput(['type'=>'text','placeholder'=>'Ваш email', 'value'=>$email])->label(false) ?>

            <?= $form->field($modelOrder, 'phone')->widget(MaskedInput::className(),[
                'mask' => '+375(99)999-99-99',
                'options' => [
                    'placeholder' => '+375(__)___-__-__'
                ]
            ])->label(false) ?>

            <?= $form->field($modelOrder, 'skype')->textInput(['placeholder' => 'Skype/Viber/WhatsApp и т.д.'])->label(false) ?>

            <div>
                <?= $form->field($modelOrder, 'count_kids')->dropDownList(range(0,12), ['prompt' => 'Кол-во детей'])->label(false) ?>
            </div>

            <div>
                <?= $form->field($modelOrder, 'count_old')->dropDownList(array_combine (range(1,20),range(1,20)), ['prompt' => 'Кол-во взрослых'])->label(false) ?>
            </div>

            <?php echo $form->field($modelOrder, 'date')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['placeholder'=>'Примерная дата']
            ])->label(false) ?>

            <?= $form->field($modelOrder, 'comment')->textarea(['placeholder' => 'Комментарий', 'rows' => 4])->label(false) ?>

            <?= $form->field($modelOrder, 'tour_id')->hiddenInput(['value'=>$model->id])->label(false) ?>

            <?= $form->field($modelOrder, 'tourfirm_id')->hiddenInput(['value'=>$model->tourfirm_id])->label(false) ?>

            <?= $form->field($modelOrder, 'user_id')->hiddenInput(['value'=>user()->id])->label(false) ?>

            <?= Html::submitButton('Отправить', ['class'=>'button yellow']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>