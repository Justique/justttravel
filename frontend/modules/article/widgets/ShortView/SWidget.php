<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 25.12.2015
 * Time: 13:42
 */
namespace frontend\modules\article\widgets\ShortView;

use yii\base\Widget;
use \common\models\Article;
/**
 * Class ArticlesWidget
 * @package frontend\widgets\ArticlesWidget
 */
class SWidget extends Widget{
    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        $data = Article::find()->all();
        return render('@frontend/modules/article/widgets/shortview/views/default',['data'=>$data]);

    }
}


