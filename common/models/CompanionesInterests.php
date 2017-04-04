<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%companiones_interests}}".
 *
 * @property integer $id
 * @property integer $companion_id
 * @property integer $interest_id
 * @property integer $ord
 *
 * @property Companiones $companion
 */
class CompanionesInterests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%companiones_interests}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\CompanionesInterestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CompanionesInterestsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companion_id', 'interest_id', 'ord'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companion_id' => 'Companion ID',
            'interest_id' => 'Interest ID',
            'ord' => 'Ord',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanion()
    {
        return $this->hasOne(Companiones::className(), ['id' => 'companion_id']);
    }
}
