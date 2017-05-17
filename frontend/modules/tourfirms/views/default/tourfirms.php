<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this \yii\web\View */
/* @var $cities common\models\Cities[] */

$this->title = 'Турфирмы';
?>

<section class="tours-page">
    <div class="content-wrapper with-counter">
        <h1>Туристические фирмы<span class="country-count"><?php echo $dataProvider->getTotalCount() ?></span></h1>
        <p>Все туристические фирмы Беларуси</p>
        <?php $form = ActiveForm::begin([
            'id' => 'tour-country-filter',
            'options'=>[
                'class'=>'regular-form'
            ]
        ]) ?>
            <?= Html::dropDownList('TourfirmsSearch[city_id]', null, $cities, [
                'id' => 'tourfirms-city',
                'prompt' => 'Выберите город',
                'options' => [
                    Yii::$app->request->get('TourfirmsSearch')['city_id'] => ['selected ' => true]
                ]
            ]) ?>
        <?php ActiveForm::end() ?>
        <p class="sort">Сортировать по:<?php echo $sort->link('name')?><?php echo $sort->link('rating')?></p>
        <div class="tourfirms">
            <?php foreach($dataProvider->getModels() as $item){ ?>

                <div class="container">
                <div>
                    <a href="/tourfirm/<?php echo $item->slug."/info"?>" class="title"><?php echo $item->name ?></a>
                    <div>
                        <div class="tour-rate">
                            <span class="rating-grade <?php echo \frontend\modules\tourfirms\Module::getStyleForReviews((float)$item->rating) ?>"><?php echo (float)$item->rating ?></span>
                            <?php if(user()->id){ ?>
                                <a class="ajax-link" href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $item->id ?>">рейтинг фирмы</a>
                            <?php }else{ ?>
                                <a class="login" href="#">рейтинг фирмы</a>
                            <?php } ?>
                            <a href="tourfirm/<?php echo $item->slug ?>/reviews">отзывы (<?php echo count($item->tourfirmReviews)?>)</a>
                        </div>
                        <div class="likes">
                            <span class="pic"></span>
                            <span><?php echo \common\models\TourfirmVotes::getCountVotes($item->id) ?></span>
                        </div>
                    </div>
                    <div><?php echo mb_substr($item->description,0,500) ?></div>
                    <div class="location">
                        <a href="/tourfirm/<?php echo $item->slug?>/contact#address-contact"><i class="fa fa-map-marker"></i><?php echo $item->address ?></a>
                    </div>
                    <div class="phones">
                        <?php if(isset($item->tourfirmsPhon->default)){ ?><span><?php echo $item->tourfirmsPhon->default ?></span><?php }?>
                        <?php if(isset($item->tourfirmsPhon->mts)){ ?><span class="mts"><?php echo $item->tourfirmsPhon->mts ?></span><?php }?>
                        <?php if(isset($item->tourfirmsPhon->life)){ ?> <span class="life"><?php echo $item->tourfirmsPhon->life ?></span><?php }?>
                        <?php if(isset($item->tourfirmsPhon->velcom)){ ?><span class="viber"><?php echo $item->tourfirmsPhon->velcom ?></span><?php }?>
                    </div>
                </div>
                <div class="pics">
                    <?php if ($item->tourfirmAttachments) {
                        $i = 1;
                        foreach ($item->tourfirmAttachments as $img) {
                            if($i > 4){
                                break;
                            }
                            else {
                                echo \yii\helpers\Html::img(
                                    Yii::$app->glide->createSignedUrl([
                                        'glide/index',
                                        'path' => $img->path,
                                        'w' => 200,
                                        'h' => 130,
                                        'fit' => 'crop',
                                        'q' => getenv('IMAGE_QUALITY')
                                    ], true),['width'=>'200px', 'height'=>'130px']
                                );
                            }
                            $i++;
                        }
                    } ?>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php echo LinkPager::widget([
            'pagination' => $dataProvider->pagination,
        ]);
        ?>
    </div>
</section>