<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%visa_favorites}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $visa_id
 */
class VisaFavorites extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%visa_favorites}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'visa_id'], 'required'],
            [['user_id', 'visa_id'], 'integer']
        ];
    }

    public function getVisa(){
        return $this->hasOne(Visa::className(), ['id' => 'visa_id']);
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

    /**
     * @inheritdoc
     * @return \common\models\query\VisaFavoritesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VisaFavoritesQuery(get_called_class());
    }
}
