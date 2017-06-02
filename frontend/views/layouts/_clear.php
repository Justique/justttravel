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
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>
    <!-- VK Widget -->
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 107433186, {tooltipButtonText: "Есть вопрос?"});
    </script>

    <!--LiveInternet counter--><script type="text/javascript">
        document.write("<a href='//www.liveinternet.ru/click' "+
            "target=_blank><img src='//counter.yadro.ru/hit?t52.1;r"+
            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
            ";"+Math.random()+
            "' alt='' title='LiveInternet: показано число просмотров и"+
            " посетителей за 24 часа' "+
            "border='0' width='88' height='31'><\/a>")
    </script><!--/LiveInternet-->

    <!--Akavita counter start-->
    <script type="text/javascript">var AC_ID=65761;var AC_TR=false;
        (function(){var l='//adlik.akavita.com/acode.js'; var t='text/javascript';
            try {var h=document.getElementsByTagName('head')[0];
                var s=document.createElement('script'); s.src=l;s.type=t;h.appendChild(s);}catch(e){
                document.write(unescape('%3Cscript src="'+l+'" type="'+t+'"%3E%3C/script%3E'));}})();
    </script><span id="AC_Image"></span>
    <noscript><a target='_blank' href='http://www.akavita.by/'>
            <img src='//adlik.akavita.com/bin/lik?id=65761&it=1'
                 border='0' height='1' width='1' alt='Akavita'/>
        </a></noscript>
    <!--Akavita counter end-->
<?php endif; ?>
</html>
<?php $this->endPage() ?>
