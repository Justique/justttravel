<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tourfirm_work_time}}".
 *
 * @property integer $id
 * @property integer $tourfirm_id
 * @property string $monday
 * @property string $tuesday
 * @property string $wednesday
 * @property string $thursday
 * @property string $friday
 * @property string $saturday
 * @property string $sunday
 *
 * @property Tourfirms $tourfirm
 */
class TourfirmWorkTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tourfirm_work_time}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tourfirm_id'], 'required'],
            [['tourfirm_id'], 'integer'],
            [['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'], 'string', 'max' => 20]
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
            'monday' => 'Понидельник',
            'tuesday' => 'Вторник',
            'wednesday' => 'Среда',
            'thursday' => 'Четверг',
            'friday' => 'Пятница',
            'saturday' => 'Суббота',
            'sunday' => 'Воскресенье',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourfirm()
    {
        return $this->hasOne(Tourfirms::className(), ['id' => 'tourfirm_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TourfirmWorkTimeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourfirmWorkTimeQuery(get_called_class());
    }
}
