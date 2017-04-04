<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\companiones;

use Yii;
use yii\base\Widget;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class Companiones extends Widget{

    public $companion_id;

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        $model = \common\models\Companiones::find()->where(['id'=>$this->companion_id])->one();

        return $this->render('@frontend/modules/user/widgets/companiones/views/default',['model'=>$model]);
    }
}


