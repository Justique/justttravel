<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Tourfirms]].
 *
 * @see \common\models\Tourfirms
 */
class TourfirmsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/
    public function withOneUser($id) {
        $this->andWhere(['touroperator_id' => $id]);
        return $this;
    }
    /**
     * @inheritdoc
     * @return \common\models\Tourfirms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Tourfirms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}