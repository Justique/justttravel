<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%transports}}".
 *
 * @property integer $id
 * @property string $type
 */
class Transports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transports}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TransportsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TransportsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }
}
