<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%up_visa}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $visa_id
 * @property integer $timestamp
 */
class UpVisa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%up_visa}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'visa_id', 'timestamp'], 'required'],
            [['user_id', 'visa_id', 'timestamp'], 'integer'],
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
            'timestamp' => 'Timestamp',
        ];
    }
}
