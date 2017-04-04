<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

$this->beginContent('@frontend/views/layouts/_clear.php')
?>

<?php echo $this->render('@frontend/views/layouts/b/modals'); ?>
<?php echo $this->render('@frontend/views/layouts/b/header'); ?>
<?php echo $content ?>

<?php
/** TODO:Пофиксить рендер футера */
?>
<?php  echo $this->render('@frontend/views/layouts/b/footer'); ?>

<?php $this->endContent() ?>

