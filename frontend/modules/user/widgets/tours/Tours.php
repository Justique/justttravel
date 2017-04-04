<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\tours;

use Yii;
use yii\base\Widget;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class Tours extends Widget{

    public $tour_id;

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        $model = \common\models\Tours::find()->where(['id'=>$this->tour_id])->one();
        //========================


        //========================
        return $this->render('@frontend/modules/user/widgets/tours/views/default',['model'=>$model, 'tour_id'=>$this->tour_id]);
    }
}


