<?php

namespace frontend\modules\companions\controllers;

use common\models\Interests;
use sjaakp\taggable\TagSuggestAction;
use yii\web\Controller;

class InterestsController extends Controller
{
    public function actions()    {
        return [
            'suggest' => [
                'class' => TagSuggestAction::className(),
                'tagClass' => Interests::className(),
            ],
        ];
    }
}
