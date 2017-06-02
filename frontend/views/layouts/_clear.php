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
<?php if(!YII_DEBUG): ?>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?137"></script>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?137"></script>
    <!-- VK Widget -->
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 107433186, {expandTimeout: "5000",widgetPosition: "left",tooltipButtonText: "Есть вопрос?"});
    </script>
<?php endif; ?>
</html>
<?php $this->endPage() ?>
