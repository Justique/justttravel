<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\Status;

use Yii;
use yii\base\Widget;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class Status extends Widget{

    public $model;
    public $name;
    public $field;
    public $title = 'заявка';

    public function init()
    {
        parent::init();
    }
    /**
     * @return string
     */
    public function run()
    {
        return $this->render('@frontend/modules/user/widgets/status/views/default',['model'=>$this->model,'name'=>$this->name,'field'=>$this->field,'title'=>$this->title]);
    }
}