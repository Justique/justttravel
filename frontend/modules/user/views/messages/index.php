<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messages-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="head-symbol"><i class="fa fa-comments-o"></i></div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="content">
        <section>
            <div class="wrapper">
                <?php if($dataProvider->getModels()){ ?>
                    <?php foreach ($dataProvider->getModels() as $message) { ?>
                        <div class="message <?php if($message->status === 1){ echo 'fresh'; } ?> ">
                            <?php
                            echo Html::img(
                                Yii::$app->glide->createSignedUrl([
                                    'glide/index',
                                    'path' => $message->userProfile->avatar_path,
                                    'w' => 100,
                                    'q' => getenv('IMAGE_QUALITY')
                                ], true)
                            );
                            ?>
                            <div>
                                <a href="/user/default/messages?messager_id=<?php echo $message->from_id?>"><?php echo ($message->userProfile->firstname && $message->userProfile->lastname) ? $message->userProfile->firstname." ".$message->userProfile->lastname : $message->user->username ?></a>
                                <span class="datemark"><?php echo date('d-m-Y',$message->created_at) ?></span>
                            </div>
                            <p><?php echo $message->message ?></p>
                        </div>
                    <?php } ?>
                <?php }else{ ?>
                    <h1>Диалогов нет</h1>
                <?php } ?>
            </div>
        </section>
    </div>
    <?php echo \yii\widgets\LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);
    ?>
    <div style="display: none">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'from_id',
            'whom_id',
            'message',
            'status',
            // 'is_delete_from',
            // 'is_delete_whom',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>

