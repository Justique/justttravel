<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%tours_order}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tour_id
 * @property string $name
 * @property string $date
 * @property string $email
 * @property string $phone
 * @property string $skype
 * @property integer $count_kids
 * @property integer $count_old
 * @property string $comment
 * @property integer $created
 *
 * @property Tours $tour
 */
class ToursOrder extends \yii\db\ActiveRecord
{
    public $updated_at;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tours_order}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ToursOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ToursOrderQuery(get_called_class());
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
            [['user_id', 'tour_id', 'name', 'email', 'phone', 'date', 'tourfirm_id'], 'required'],
            [['email'], 'email'],
            [['comment'], 'string'],
            [['count_kids', 'count_old'], 'default', 'value' => 0],
            [['user_id', 'tour_id', 'count_kids', 'count_old', 'created'], 'integer'],
            [['name', 'email', 'phone', 'skype'], 'string', 'max' => 100],
            [['date'], 'string', 'max' => 50]
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
            'name' => 'Имя',
            'date' => 'Примерная дата',
            'email' => 'Email',
            'phone' => 'Телефон',
            'skype' => 'Skype/Viber/WhatsApp и т.д.',
            'count_kids' => 'Кол-во детей',
            'count_old' => 'Кол-во взрослых',
            'comment' => 'Комментарий',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getTour()
    {
        return $this->hasOne(Tours::className(), ['id' => 'tour_id']);
    }

    public function getUser()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
    }
}
