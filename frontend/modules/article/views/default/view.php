<?php
/* @var $this yii\web\View */
/* @var $model common\models\Article */
//$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Articles'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<section class="tour-full-page">
    <div class="content-wrapper">
        <h1 class="mid-head"><?php echo $model->getCF('title'); ?>е</h1>
        <?php
        $path = Yii::$app->glide->createSignedUrl([
                'glide/index',
                'path' => $model->thumbnail_path,
                'w' => 200,
                'q' => getenv('IMAGE_QUALITY')
            ], true);

        if( $model->articleAttachments) {
            foreach($model->articleAttachments as $img) {
                echo \yii\helpers\Html::img(
                    Yii::$app->glide->createSignedUrl([
                        'glide/index',
                        'path' => $img->path,
                        'w' => 200,
                        'q' => getenv('IMAGE_QUALITY')
                    ], true)
                );
            }
        }
        ?>
        <div class="company-desc-text">
        <!--    <h2><?php echo $model->getCF('title'); ?></h2>
            <h3><?php echo $model->getCF('title'); ?></h3>
            <h4><?php echo $model->getCF('title'); ?></h4>
            <h5><?php echo $model->getCF('title'); ?></h5> -->
            <div><?php echo $model->body; ?></div>
        </div>
        <script type="text/javascript">
         (function() {
                  if (window.pluso)if (typeof window.pluso.start == "function") return;
                  if (window.ifpluso==undefined) { window.ifpluso = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                    var h=d[g]('body')[0];
                    h.appendChild(s);
                    }})();
        </script>
        <div class="pluso" data-background="#ebebeb" data-options="big,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>
        <hr class="medium">


    </div>
</section>
