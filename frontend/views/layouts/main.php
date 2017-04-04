<?php
/* @var $this \yii\web\View */
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

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
                swal('Успешно', '" . $alert['body'] . "', 'success');
            "); ?>
        <?php endif; ?>
        </div>
        <?php echo $content ?>
<?php $this->endContent() ?>