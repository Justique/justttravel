<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cities}}".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $city
 * @property string $state
 * @property string $region
 * @property integer $biggest_city
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cities}}';
    }

    public static function getCity($id){
        $data = Cities::find()->where(['id' => $id])->one();
        return $data ? $data->city : 'Не задано';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\CitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CitiesQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'city', 'region'], 'required'],
            [['id', 'country_id', 'biggest_city'], 'integer'],
            [['city', 'state', 'region'], 'string', 'max' => 255],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'city' => 'City',
            'state' => 'State',
            'region' => 'Region',
            'biggest_city' => 'Biggest City',
        ];
    }
    
    /**
     * 
     * @return string
     */
    public function getFullTitle()
    {
        if($this->region) {
            return $this->city . " ({$this->region})";
        }
        return $this->city;
    }
}
