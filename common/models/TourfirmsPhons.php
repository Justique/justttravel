<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tourfirms_phons}}".
 *
 * @property integer $id
 * @property integer $tourfirm_id
 * @property string $default
 * @property string $mts
 * @property string $life
 * @property string $viber
 * @property string $skype
 * @property string $icq
 *
 * @property Tourfirms $tourfirm
 */
class TourfirmsPhons extends \yii\db\ActiveRecord
{
    public $phone1;
    public $phone2;
    public $phone3;
    public $phone4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tourfirms_phons}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TourfirmsPhonsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourfirmsPhonsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tourfirm_id'], 'required'],
            [['tourfirm_id'], 'integer'],
            [['default', 'mts', 'life', 'viber', 'skype', 'icq'], 'string', 'max' => 80]
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
            'default' => 'Городской',
            'mts' => 'Mts',
            'life' => 'Life',
            'viber' => 'Viber',
            'skype' => 'Skype',
            'icq' => 'Icq',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourfirm()
    {
        return $this->hasOne(Tourfirms::className(), ['id' => 'tourfirm_id']);
    }
}
