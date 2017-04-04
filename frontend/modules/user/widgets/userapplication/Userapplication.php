<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\user\widgets\userapplication;

use common\models\search\ApplicationForToursSearch;
use Yii;
use yii\base\Widget;
use yii\data\Sort;

/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class Userapplication extends Widget{

    public $id_application;

    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
//        $model = \common\models\ApplicationForTours::find()->where(['user_application_id'=>$this->id_application])->one();
//        if($model){
//            $flag = true;
//        }
//        else {
//            $model = new \common\models\ApplicationForTours();
//            $flag = false;
//        }
        $responsesModel = new ApplicationForToursSearch();
        Yii::$app->request->queryParams = array_merge(Yii::$app->request->queryParams,['Application_id'=>$this->id_application]);
        $sort = new Sort([
            'attributes' => [
                'date_create'=>[
                    'label' => 'Дате создания'
                ],
                'price'=>[
                    'label' => 'Цене'
                ],
                'nights'=>[
                    'label' => 'Количества дней'
                ],
            ],
            'defaultOrder' => ['date_create' => SORT_ASC]
        ]);
        $responsesProvider  = $responsesModel->search(Yii::$app->request->queryParams);
        $model = \common\models\UserApplication::find()->where(['id'=>$this->id_application])->one();
        return $this->render('@frontend/modules/user/widgets/userapplication/views/default',['model'=>$model, 'responsesProvider'=>$responsesProvider, 'sort'=>$sort]);
    }

    public function goBack($defaultUrl = null)
    {
        return Yii::$app->getResponse()->redirect(Yii::$app->getUser()->getReturnUrl($defaultUrl));
    }
}


