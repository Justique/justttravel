<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%up_tour}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tour_id
 * @property integer $timestamp
 */
class UpTour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%up_tour}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tour_id', 'timestamp'], 'required'],
            [['user_id', 'tour_id', 'timestamp'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'tour_id' => 'Tour ID',
            'timestamp' => 'Timestamp',
        ];
    }
}
