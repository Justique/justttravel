<?php
/**
 * @var $this \yii\web\View
 * @var $model \common\models\Page
 */
$this->title = $model->title;
?>
<div class="content-wrapper">
    <div class="content-page">
        <h1><?php echo $model->title ?></h1>

        <?php echo $model->body ?>
    </div>
</div>