<?php

use common\models\Tourfirms;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\user\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $canCreate boolean */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="head-symbol"><i class="fa fa-newspaper-o"></i></div>

<h1><?= Html::encode($this->title) ?></h1>

<?php if(Tourfirms::getTourfirmId(user()->id)){ ?>

    <?php if ($canCreate): ?>
        <p>
            <?= Html::a('Создать новость', ['create'], ['class' => 'button yellow button_main']) ?>
        </p>
    <?php endif; ?>
<div class="article-index" style="display: none;">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'slug',
            'title',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
    <section>
        <div class="wrapper">
            <div class="wrapper-inner">
                <div class="grid">
                    <?php foreach ($dataProvider->getModels() as $article) { ?>
                        <div class="grid-item grid-item--double-height">
                            <div class="container">
                                <?php
                                echo Html::img(
                                    Yii::$app->glide->createSignedUrl([
                                        'glide/index',
                                        'path' => $article->thumbnail_path,
                                        'w' => 100
                                    ], true)
                                );
                                ?>
                                <span class="label-news"><?php echo $article->category->title ?></span>
                                <span class="label-date"><?php echo date('d-m-Y',$article->created_at) ?></span>
                                <div class="controls">
                                    <a href="/user/news/update?id=<?php echo $article->id ?>" class="edit"><i class="fa fa-pencil-square-o"></i></a>
                                    <a href="/user/news/delete?id=<?php echo $article->id ?>" class="delete"  title="удалить" aria-label='Удалить' data-confirm='Вы уверены, что хотите удалить этот элемент?' data-method='post' data-pjax=0><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <h3><?php echo $article->title ?></h3>
                            <br>
                            <p><?php echo $article->body ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php }else {?>
    <p>
        Турфирма еще не создана!
    </p>
<?php } ?>