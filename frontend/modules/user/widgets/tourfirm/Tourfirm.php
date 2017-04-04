<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\tourfirm;

use common\models\TourfirmsPhons;
use common\models\TourfirmWorkTime;
use common\models\User;
use Yii;
use yii\base\Widget;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class Tourfirm extends Widget{

    public $tourfirm_id;

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        $model = \common\models\Tourfirms::find()->where(['id'=>$this->tourfirm_id])->one();
        $modelPhons = User::getModelPage(TourfirmsPhons::className(), 'tourfirm_id');
        //========================

        $modelWorkTime = User::getModelPage(TourfirmWorkTime::className(), 'tourfirm_id');

        //========================
        return $this->render('@frontend/modules/user/widgets/tourfirm/views/default',['model'=>$model, 'modelPhons'=>$modelPhons, 'modelWorkTime'=>$modelWorkTime, 'tourfirm_id'=>$this->tourfirm_id]);
    }
}


