<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%companiones_gender}}".
 *
 * @property integer $id
 * @property string $class_gender
 * @property string $gender
 */
class CompanionesGender extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%companiones_gender}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_gender', 'gender'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_gender' => 'Class Gender',
            'gender' => 'Gender',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\CompanionesGenderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CompanionesGenderQuery(get_called_class());
    }
}
