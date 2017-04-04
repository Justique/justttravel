<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="head-symbol"><i class="fa fa-commenting"></i></div>
<h1><?= Html::encode($this->title) ?></h1>
<section class="register-page">
    <div class="content-wrapper">
        <div class="container">


            <div class="test" style="
    width: 50%;
    margin: 0 auto;
">

                <p>
                    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'slug',
                        'title',
                        'body:ntext',
                        'view',
                        'category_id',
                        'thumbnail_base_url:url',
                        'thumbnail_path',
                        'author_id',
                        'updater_id',
                        'status',
                        'published_at',
                        'created_at',
                        'updated_at',
                        'is_big',
                        'user_id',
                    ],
                ]) ?>
            </div>

        </div>
    </div>
</section>



