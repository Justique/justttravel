<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TourAttachment]].
 *
 * @see \common\models\TourAttachment
 */
class TourAttachmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TourAttachment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TourAttachment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}