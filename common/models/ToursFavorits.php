<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tours_favorits}}".
 *
 * @property integer $id
 * @property string $ip
 * @property integer $tour_id
 *
 * @property Tours $tour
 */
class ToursFavorits extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tours_favorits}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id'], 'required'],
            [['tour_id','user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User_id',
            'tour_id' => 'Tour ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tours::className(), ['id' => 'tour_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ToursFavoritsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ToursFavoritsQuery(get_called_class());
    }
}
