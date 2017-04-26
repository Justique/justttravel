<?php

use common\models\Cities;
use common\models\Countries;
use common\models\Tourfirms;
use common\models\Tours;
use frontend\modules\article\Module as Module2;
use frontend\modules\tourfirms\Module as Module4;
use frontend\modules\tours\Module as Module3;
use frontend\modules\tours\widgets\IndexFilterWidget;
use frontend\modules\user\Module;
use yii\helpers\Html;
/*
 * @var $articles \common\models\Article
 * @var $big \common\models\Article
 */
?>
<section>
    <div class="content-wrapper">
        <h1>Подбери тур своей мечты!</h1>
        <p>Поиск туров от всех турфирм Республики Беларусь</p>
        <?php echo IndexFilterWidget::widget(); ?>
    </div>
</section>
<div class="sinusoid"></div>

<section>
    <div class="content-tours">
        <section class="tours">
            <h1>Новые туры</h1>
            <h2>Недавно добавленные туры белорусских турфирм</h2>
            <ul class="tours-list">
                <?php foreach($tours->query as $item){ ?>
                    <li class="<?php if($countComp = Module3::getComparison($item->id)){echo "green";} ?> comparing">
                        <a href="/tour/<?php echo $item->slug ?>" class="tour-link"></a>
                        <div class="tour-name">
                            <a href="/tourfirm/<?php echo $item->tourfirm->slug ?>/info" class="blue"><?php echo $item->tourfirm->name ?></a>
                            <div class="tour-rate">
                                    <span class="rating-grade <?php echo Module4::getStyleForReviews($item->tourfirm->rating) ?>"><?php echo (float)$item->tourfirm->rating ?></span>
                                    <?php if(user()->id){ ?>
                                        <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $item->tourfirm_id ?>">рейтинг фирмы</a>
                                    <?php }else{ ?>
                                        <a class="login" href="#">рейтинг фирмы</a>
                                    <?php } ?>
                                </div>
                            <p>добавлен <?php echo convertDate($item->published_at)?></p>
                        </div>
                        <div class="general">
                            <div class="tour-type"><i class="fa fa-<?php echo $item->transport->class ?>"></i><span><?php echo $item->transport->type ?></span></div>
                            <?php echo Module::getCountPeoples($item->count_old, $item->count_kids) ?>
                            <?php if($item->hot){ ?>
                                <div class="tour-hot visible">горящий тур</div>
                            <?php } ?>
                        </div>
                        <div class="tour-destination">
                            <i class="fa fa-map-marker"></i>
                            <a href="/tours?ToursSearch[country_to_id]=<?php echo $item->country_to_id ?>" class="blue"><?php echo $item->country->name ?></a>
                            <a href="/tours?ToursSearch[city_to_id]=<?php echo $item->city_to_id ?>" class="tour-destination__city"><?php echo $item->city->city ?></a>
                        </div>
                        <div class="tour-hotel">
                            <?php if($item->hotel_title && $item->hotel_url && $item->hotel_rating): ?>
                            <a href="<?=$item->hotel_url?>" class="blue"><?=$item->hotel_title?></a>
                            <div class="tour-hotel-rate">
                                <div class="rating-grade <?php echo Module4::getStyleForReviews((float)$item->hotel_rating) ?>" title="Рейтинг актуален на момент добавления тура. Текущий рейтинг вы можете посмотреть, перейдя по ссылке на отель"><?=$item->hotel_rating?></div>
                                <a href="<?=$item->hotel_url?>">рейтинг Tophotels</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="tour-duration">
                            <i class="fa fa-clock-o"></i>
                            <p><?php echo $item->count_days ?> ночей</p>
                            <p><?php echo $item->count_nights ?> дней</p>
                        </div>
                        <div class="tour-transport">
                            <i class="fa fa-calendar-check-o"></i>
                            <p><?php echo $item->fromCity->city ?></p>
                            <p><?php echo $item->date_from ?></p>
                        </div>
                        <div class="tour-price">
                            <p><?php echo $item->price ?><span>руб.</span></p>
                            <?php if(!user()->id){ ?>
                                <div>
                                    <a href="#" class="login"><div class="tour-compare plus"></div></a>
                                    <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                                </div>
                            <?php }else{ ?>
                                <div>
                                    <?php if($countComp){ ?>
                                        <a href="/tours/comparison?comparison_save=0&tour_id=<?php echo $item->id ?>&tourfirm_id=<?php echo $item->tourfirm_id ?>"class="ajax-link"><div class="tour-compare minus"></div></a>
                                    <?php }else{?>
                                        <a href="/tours/comparison?comparison_save=1&tour_id=<?php echo $item->id ?>&tourfirm_id=<?php echo $item->tourfirm_id ?>"class="ajax-link"><div class="tour-compare plus"></div></a>
                                    <?php }?>
                                    
                                    
                                    <?php if(Module3::getFavorits($item->id)){ ?>
                                        <div class="tour-like"><a href="/tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                                    <?php }else{?>
                                        <div class="tour-like"><a href="/tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <a href="/tours?sort=-created_at" class="button-hollow">Больше туров</a>
        </section>
    </div>
</section>
<div class="sinusoid"></div>
<section class="news-block">
    <div class="content-wrapper">
        <h1>Новости портала</h1>
        <p>Новости туризма и наших турфирм</p>
        <div class="grid js-masonry" data-masonry-options='{"itemSelector": ".grid-item", "columnWidth": 255, "gutter": 30}'>
            <?php if($big): ?>
                <a href="/article/<?php echo $big->slug; ?>" class="grid-item grid-item--quad">
                    <div class="container">
                        <?php
                        $path = Yii::$app->glide->createSignedUrl(['glide/index', 'path' => $big->thumbnail_path, 'w' => 530], true);
                        if (checkRemoteFile($path) == false) {
                            echo Html::img('/v1/img/grid-item.jpg');
                        } else {
                            echo Html::img(
                                Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $big->thumbnail_path,
                                    'w' => 530
                                ], true)
                            );
                        }
                        ?>
                        <span class="label-news">новости</span>
                        <span class="label-date"><?php echo $big->getDate(); ?></span>
                        <div class="mask"></div>
                    </div>
                    <span class="label-desc"><?php echo $big->getCF('title'); ?></span>
                </a>
            <?php endif; ?>
            <?php foreach ($articles as $model): ?>
                <a href="/article/<?php echo $model->slug; ?>" class="grid-item grid-item--double-width">
                    <div class="container">
                        <?php
                        $path = Yii::$app->glide->createSignedUrl(['glide/index', 'path' => $model->thumbnail_path, 'w' => 100], true);
                        if (checkRemoteFile($path) == false) {
                            echo Html::img('/v1/img/grid-item.jpg');
                        } else {
                            echo Html::img(
                                Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $model->thumbnail_path,
                                    'w' => 255
                                ], true)
                            );
                        }
                        ?>
                        <span class="label-news">новости</span>
                        <span class="label-date"><?php echo $model->getDate(); ?></span>
                    </div>
                    <h3><?php echo Html::encode($model->title); ?>...</h3>
                    <br>
                    <p><?php echo Html::decode(mb_substr($model->body,0,130,'UTF-8')); ?>...</p>
                </a>
            <?php endforeach; ?>
        </div>
        <a href="<?php echo Module2::urlAll(); ?>" class="button yellow">Все новости</a>
        <div class="content-tours" style="display: none;">
            <section class="tours">
                <h1>Обрати внимание!</h1>
                <p>Туры, на которые стоит обратить внимание :)</p>
                <ul class="tours-list">
                    <?php foreach($tours->query as $item){ ?>
                        <li class="<?php if($countComp = Module3::getComparison($item->id)){echo "green";} ?> comparing">
                            <a href="/tour/<?php echo $item->slug ?>" class="tour-link"></a>
                            <div class="tour-name">
                                <a href="/tourfirm/<?php echo $item->tourfirm->slug ?>/info" class="blue"><?php echo $item->tourfirm->name ?></a>
                                <div class="tour-rate">
                                        <span class="rating-grade <?php echo Module4::getStyleForReviews($item->tourfirm->rating) ?>"><?php echo (float)$item->tourfirm->rating ?></span>
                                        <?php if(user()->id){ ?>
                                            <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $item->tourfirm_id ?>">рейтинг фирмы</a>
                                        <?php }else{ ?>
                                            <a class="login" href="#">рейтинг фирмы</a>
                                        <?php } ?>
                                    </div>
                                <p>добавлен <?php echo convertDate($item->published_at)?></p>
                            </div>
                            <div class="general">
                                <div class="tour-type"><i class="fa fa-<?php echo $item->transport->class ?>"></i><span><?php echo $item->transport->type ?></span></div>
                                <?php echo Module::getCountPeoples($item->count_old, $item->count_kids) ?>
                                <?php if($item->hot){ ?>
                                    <div class="tour-hot visible">горящий тур</div>
                                <?php } ?>
                            </div>
                            <div class="tour-destination">
                                <i class="fa fa-map-marker"></i>
                                <a href="/tours?ToursSearch[country_to_id]=<?php echo $item->country_to_id ?>" class="blue"><?php echo $item->country->name ?></a>
                                <a href="/tours?ToursSearch[city_to_id]=<?php echo $item->city_to_id ?>" class="tour-destination__city"><?php echo $item->city->city ?></a>
                            </div>
                            <div class="tour-hotel">
                                <?php if($item->hotel_title && $item->hotel_url && $item->hotel_rating): ?>
                                <a href="<?=$item->hotel_url?>" class="blue"><?=$item->hotel_title?></a>
                                <div class="tour-hotel-rate">
                                    <div class="rating-grade <?php echo Module4::getStyleForReviews((float)$item->hotel_rating) ?>" title="Рейтинг актуален на момент добавления тура. Текущий рейтинг вы можете посмотреть, перейдя по ссылке на отель"><?=$item->hotel_rating?></div>
                                    <a href="<?=$item->hotel_url?>">рейтинг Tophotels</a>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="tour-duration">
                                <i class="fa fa-clock-o"></i>
                                <p><?php echo $item->count_days ?> ночей</p>
                                <p><?php echo $item->count_nights ?> дней</p>
                            </div>
                            <div class="tour-transport">
                                <i class="fa fa-calendar-check-o"></i>
                                <p><?php echo $item->fromCity->city ?></p>
                                <p><?php echo $item->date_from ?></p>
                            </div>
                            <div class="tour-price">
                                <p><?php echo $item->price ?><span>руб.</span></p>
                                <?php if(!user()->id){ ?>
                                    <div>
                                        <a href="#" class="login"><div class="tour-compare plus"></div></a>
                                        <div class="tour-like"><a href="#" class="login"><div class="heart"></div></a><span></span></div>
                                    </div>
                                <?php }else{ ?>
                                    <div>
                                        <?php if($countComp){ ?>
                                            <a href="/tours/comparison?comparison_save=0&tour_id=<?php echo $item->id ?>&tourfirm_id=<?php echo $item->tourfirm_id ?>"class="ajax-link"><div class="tour-compare minus"></div></a>
                                        <?php }else{?>
                                            <a href="/tours/comparison?comparison_save=1&tour_id=<?php echo $item->id ?>&tourfirm_id=<?php echo $item->tourfirm_id ?>"class="ajax-link"><div class="tour-compare plus"></div></a>
                                        <?php }?>

                                        <?php if(Module3::getFavorits($item->id)){ ?>
                                            <div class="tour-like"><a href="/tours/favorits?save=0&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart full"></div></a><span></span></div>
                                        <?php }else{?>
                                            <div class="tour-like"><a href="/tours/favorits?save=1&tour_id=<?php echo $item->id ?>" class="ajax-link"><div class="heart"></div></a><span></span></div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </section>
        </div>
    </div>
</section>
<section>
    <div class="content-wrapper">
        <?php if($newReviews){ ?>
            <h1>Новые отзывы</h1>
            <p>Недавно добавленные отзывы о турфирмах</p>
            <div class="reports-container">
                <?php foreach($newReviews as $review){ ?>
                    <div class="report">
                        <a href="/tourfirm/<?php echo $review->tourfirm->slug ?>/info"><?php echo $review->tourfirm->name ?></a>
                        <div class="rating-grade <?php echo Module4::getStyleForReviews(Tourfirms::getPercentVotes($review->id)) ?>"><?php echo Tourfirms::getPercentVotes($review->id) ?></div>
                        <hr>
                        <p><?php echo $review->comment?></p>
                    </div>
                <?php } ?>
            </div>
        <?php }else{ ?>
            <h1>Новых отзывов нету</h1>
        <?php } ?>
    </div>
</section>
<section>
    <div class="content-wrapper with-counter">
        <h1>Все туры<span class="tour-count"><?php echo Tours::find()->count() ?></span></h1>
        <p>Туры всех компаний из нашего каталога</p>
        <div class="tour-container">
           <?php
           foreach(array_chunk_fixed($countries,3) as $cntr) {?>
                <ul>
                    <?php foreach($cntr as $item){ ?>
                        <?php if(count($item->tours)){ ?>
                            <li><a href="/tours?ToursSearch[country_to_id]=<?php echo $item->country_id ?>"><?php echo $item->name . " (".count($item->tours).") "?> от <?php echo Tours::getSmallPrice($item->tours) ?> руб.</a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
           <?php } ?>
        </div>
    </div>
</section>
