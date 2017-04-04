<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%messages}}".
 *
 * @property integer $id
 * @property integer $from_id
 * @property integer $whom_id
 * @property string $message
 * @property integer $status
 * @property integer $is_delete_from
 * @property integer $is_delete_whom
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $from
 * @property User $whom
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%messages}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\MessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\MessagesQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_id', 'whom_id', 'status', 'is_delete_from', 'is_delete_whom', 'created_at', 'updated_at'], 'integer'],
            [['whom_id', 'message', 'created_at', 'updated_at'], 'required'],
            [['message'], 'string', 'max' => 750]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_id' => 'From ID',
            'whom_id' => 'Whom ID',
            'message' => 'Message',
            'status' => 'Status',
            'is_delete_from' => 'Is Delete From',
            'is_delete_whom' => 'Is Delete Whom',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom()
    {
        return $this->hasOne(User::className(), ['id' => 'from_id']);
    }

    public function getUserProfile() {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'from_id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWhom()
    {
        return $this->hasOne(User::className(), ['id' => 'whom_id']);
    }
}
