<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%user_iformation}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $question
 */
class UserIformation extends \yii\db\ActiveRecord
{
    public $updated_at;

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
    public static function tableName()
    {
        return '{{%user_iformation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'question', 'email', 'user_id'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['question'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'question' => 'Question',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\UserIformationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserIformationQuery(get_called_class());
    }
}
