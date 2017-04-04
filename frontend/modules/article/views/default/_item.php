<?php
/**
 * @var $this yii\web\View
 * @var $model \common\models\Article
 */
use yii\helpers\Html;

?>
<a href="<?php echo $model->getViewUrl(); ?>" class="grid-item grid-item--double-width">
    <?php if ($model->thumbnail_path): ?>
        <?php echo Html::img(
            Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->thumbnail_path,
                'w' => 100
            ], true),
            ['class' => 'article-thumb img-rounded pull-left']
        ) ?>
    <?php endif; ?>
    <div class="container">
        <span class="label-news">новости</span>
        <span class="label-date"><?php echo $model->getDate(); ?></span>
    </div>
    <h3><?php echo $model->getCF('title'); ?></h3>
    <br>
    <p><?php echo $model->getAnnounce('190'); ?></p>
</a>
