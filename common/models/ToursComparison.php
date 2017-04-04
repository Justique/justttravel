<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tours_comparison}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tour_id
 */
class ToursComparison extends \yii\db\ActiveRecord
{

    public $count_nights;
    public $price;
    public $created_at;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tours_comparison}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ToursComparisonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ToursComparisonQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tour_id','tourfirm_id'], 'required'],
            [['user_id', 'tour_id','tourfirm_id'], 'integer'],
            [['price', 'count_nights','created_at'], 'safe']
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
        ];
    }

    public function getTour() {
        return $this->hasOne(Tours::className(), ['id' => 'tour_id']);
    }
}
