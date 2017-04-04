<?php

namespace frontend\modules\tours\widgets;

use yii\base\Widget;

class IndexFilterWidget extends Widget
{
    public $template = 'index-filter';

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
        return $this->render($this->template);
    }
}