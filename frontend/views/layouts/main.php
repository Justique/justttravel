<?php
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/base.php')
?>
<div class="wrapper">
    <?php echo Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?php if(Yii::$app->session->hasFlash('alert')):?>
        <?php
        $alert = Yii::$app->session->getFlash('alert');
        $this->registerJs("
            swal('Успешно', '" . $alert . "', 'success');
        "); ?>
    <?php endif; ?>
</div>

<?php echo $content ?>

<?php $this->endContent() ?>