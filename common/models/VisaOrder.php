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
 * @property string $phone
 * @property string $skype
 * @property integer $count_kids
 * @property integer $count_old
 * @property integer $date
 * @property string $comment
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
            [['user_id', 'visa_id', 'name', 'email', 'phone', 'date', 'tourfirm_id'], 'required'],
            [['visa_id', 'count_kids', 'count_old', 'tourfirm_id'], 'integer'],
            [['comment'], 'string'],
            [['user_id', 'name', 'email'], 'string', 'max' => 100],
            [['phone', 'skype'], 'string', 'max' => 255],
            [['visa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Visa::className(), 'targetAttribute' => ['visa_id' => 'id']],
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
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'skype' => 'Skype/Viber/WhatsApp и т.д.',
            'count_kids' => 'Кол-во детей',
            'count_old' => 'Кол-во взрослых',
            'date' => 'Дата',
            'comment' => 'Комментарий',
            'created' => 'Created',
            'tourfirm_id' => 'Tourfirm ID',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $this->date = strtotime($this->date);
                $this->count_kids = $this->count_kids ? $this->count_kids : 0;
                $this->count_old = $this->count_old ? $this->count_old : 0;
            }
            return true;
        }
        return false;
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
