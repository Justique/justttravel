<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\applicationfortours;

use Yii;
use yii\base\Widget;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class Applicationfortours extends Widget{

    public $user_application_id;
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
        $model = \common\models\ApplicationForTours::find()->where(['user_application_id'=>$this->user_application_id, 'tourfirm_id'=>$this->tourfirm_id])->one();
        if($model){
            $flag = true;
        }
        else {
            $model = new \common\models\ApplicationForTours();
            $flag = false;
        }
        return $this->render('@frontend/modules/user/widgets/applicationfortours/views/default',['model'=>$model, 'flag'=>$flag,'id_application'=>$this->user_application_id]);
    }

    public function goBack($defaultUrl = null)
    {
        return Yii::$app->getResponse()->redirect(Yii::$app->getUser()->getReturnUrl($defaultUrl));
    }
}


