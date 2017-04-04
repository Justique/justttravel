<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\visa;

use Yii;
use yii\base\Widget;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class Visa extends Widget{

    public $visa_id;

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        $model = \common\models\Visa::find()->where(['id'=>$this->visa_id])->one();
        //========================


        //========================
        return $this->render('@frontend/modules/user/widgets/visa/views/default',['model'=>$model]);
    }
}


