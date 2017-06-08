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
    <meta name="description" content="Justtravel.by - агрегатор белорусских турфирм. Поиск туров, сравнение цен, каталог турфирм с отзывами. Поиск попутчиков, онлайн заявки, горящие туры">
    <meta name="keywords" content="Турфирмы, Беларусь, туры, визы, цены, онлайн, заявки, путёвки">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
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
        var counter = "<a href='//www.liveinternet.ru/click' "+
            "target=_blank><img src='//counter.yadro.ru/hit?t52.1;r"+
            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
            ";"+Math.random()+
            "' alt='' title='LiveInternet: показано число просмотров и"+
            " посетителей за 24 часа' "+
            "border='0' width='88' height='31'><\/a>";

        var element = document.createElement('div');
        element.innerHTML = counter;
        document.getElementById('counters').appendChild(element);
    </script><!--/LiveInternet-->
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter34041820 = new Ya.Metrika({
                        id:34041820,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/34041820" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-100338130-1', 'auto');
        ga('send', 'pageview');

    </script>
<?php endif; ?>
</html>
<?php $this->endPage() ?>
