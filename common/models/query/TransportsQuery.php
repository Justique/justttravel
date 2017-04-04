<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Transports]].
 *
 * @see \common\models\Transports
 */
class TransportsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Transports[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Transports|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}