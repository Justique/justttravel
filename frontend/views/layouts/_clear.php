<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html ng-app lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="/js/locationpicker.jquery.js"></script>
    <?php echo Html::csrfMetaTags() ?>
    <script>
        var selectApis = [];
    </script>
</head>
<body class="office">
<?php $this->beginBody() ?>

    <?php echo $content ?>
<?php $this->endBody() ?>


</body>

</html>
<?php $this->endPage() ?>
