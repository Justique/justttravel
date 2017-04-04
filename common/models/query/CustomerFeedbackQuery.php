<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\CustomerFeedback]].
 *
 * @see \common\models\CustomerFeedback
 */
class CustomerFeedbackQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\CustomerFeedback[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\CustomerFeedback|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}