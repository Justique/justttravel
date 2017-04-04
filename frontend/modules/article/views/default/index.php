<?php
/**
 * @var $model \common\models\Article
 * @var $big \common\models\Article
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
<section class="all-news">
    <div class="content-wrapper">
        <h1>Новости портала</h1>
        <p>Новости портала</p>
        <div class="grid js-masonry"
             data-masonry-options='{ "itemSelector": ".grid-item", "columnWidth": 250, "gutter": 30 }'>
            <?php if($big) {?>
            <a href="<?php echo $big->getViewUrl(); ?>" class="grid-item grid-item--quad">
                <div class="container">
                    <span class="label-news">новости</span>
                    <span class="label-date"><?php echo $big->getDate(); ?></span>
                    <?php
                    $path = Yii::$app->glide->createSignedUrl(['glide/index', 'path' => $big->thumbnail_path, 'w' => 530], true);
                    if (checkRemoteFile($path) == false) {
                        //echo Html::img('/v1/img/grid-item.jpg');
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
                    <div class="mask"></div>
                </div>
                <span class="label-desc"><?php echo $big->getCF('title'); ?></span>
            </a>
            <?php }?>
            <?php foreach ($models as $model) { ?>
                <a href="<?php echo $model->getViewUrl(); ?>" class="grid-item grid-item--double-width">
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
            <?php } ?>
        </div>
        <?php echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
</section>