<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%customer_feedback}}".
 *
 * @property integer $id
 * @property integer $tourfirm_id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $question
 * @property integer $date_create
 */
class CustomerFeedback extends \yii\db\ActiveRecord
{

    public $upload_files;
    public $coordinates;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer_feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tourfirm_id', 'user_id', 'date_create'], 'integer'],
            [['date_create','user_id', 'name'], 'required'],
            [['name', 'phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
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
            'tourfirm_id' => 'Tourfirm ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'question' => 'Question',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\CustomerFeedbackQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CustomerFeedbackQuery(get_called_class());
    }

}
