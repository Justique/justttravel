<?php

namespace frontend\modules\tourfirms\widgets;

use yii\base\Widget;

class TourfirmHeaderWidget extends Widget
{
    public $template = 'tourfirm-header';
    public $model;

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
            'model'=> $this->model,
        ]);
    }
}