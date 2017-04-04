<?php

namespace common\models;

use common\models\query\CompanionesCompanyQuery;
use Yii;

/**
 * This is the model class for table "{{%companiones_company}}".
 *
 * @property integer $id
 * @property string $man
 * @property string $woman
 * @property integer $companion_id
 *
 * @property Companiones $companion
 */
class CompanionesCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%companiones_company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companion_id'], 'integer'],
            [['man', 'woman', 'company'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'man' => 'Man',
            'woman' => 'Woman',
            'company' => 'Company',
            'companion_id' => 'Companion ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanion()
    {
        return $this->hasOne(Companiones::className(), ['id' => 'companion_id']);
    }

    /**
     * @inheritdoc
     * @return CompanionesCompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanionesCompanyQuery(get_called_class());
    }
}
