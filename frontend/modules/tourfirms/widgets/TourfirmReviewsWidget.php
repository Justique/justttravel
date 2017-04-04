<?php

namespace frontend\modules\tourfirms\widgets;

use yii\base\Widget;

class TourfirmReviewsWidget extends Widget
{
    public $template = 'tourfirm-reviews';
    public $id;
    public $slug;
    public $options;
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render($this->template, [
            'id'=> $this->id,
            'slug'=> $this->slug,
        ]);
    }
}