<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%visa_order}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $visa_id
 * @property string $name
 * @property string $email
 * @property string $created
 *
 * @property Visa $visa
 */
class VisaOrder extends \yii\db\ActiveRecord
{
    public $updated_at;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%visa_order}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\VisaOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VisaOrderQuery(get_called_class());
    }

    public function behaviors()
    {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'value' => new Expression(time()),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'visa_id', 'name', 'email','tourfirm_id'], 'required'],
            [['visa_id'], 'integer'],
            [['user_id', 'name', 'email'], 'string', 'max' => 100],
            [['created'], 'string', 'max' => 50]
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
            'name' => 'Name',
            'email' => 'Email',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisa()
    {
        return $this->hasOne(Visa::className(), ['id' => 'visa_id']);
    }

    public function getUser()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
    }
}
