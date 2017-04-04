<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%visa_comparison}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $visa_id
 */
class VisaComparison extends \yii\db\ActiveRecord
{
    public $created_at;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%visa_comparison}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\VisaComparisonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VisaComparisonQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'visa_id','tourfirm_id'], 'required'],
            [['user_id', 'visa_id','tourfirm_id'], 'integer'],
            [['created_at'], 'safe']
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
            'visa_id' => 'Visa ID',
        ];
    }

    public function getVisa() {
        return $this->hasOne(Visa::className(), ['id' => 'visa_id']);
    }
}
