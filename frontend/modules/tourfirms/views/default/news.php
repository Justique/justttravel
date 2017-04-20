<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<section class="company-page with-rating">
<section class="all-news">
    <div class="content-wrapper">
        <?php echo \frontend\modules\tourfirms\widgets\TourfirmHeaderWidget::widget(['model'=>$model]) ?>
        <h1>Новости турфирмы</h1>
        <p>&nbsp;</p>
        <?php foreach ($models as $model) { ?>
            <a href="/article/<?php echo $model->slug; ?>" class="grid-item grid-item--double-width" style="display: block; text-align: left; width: 100%;">
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
                                'w' => 100
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
        <?php } ?>
        <?php echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
</section>
</section>