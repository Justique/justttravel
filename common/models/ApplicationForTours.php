<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%application_for_tours}}".
 *
 * @property integer $id
 * @property integer $country_to_id
 * @property integer $city_to_id
 * @property string $date
 * @property integer $price
 * @property integer $adults
 * @property integer $childrens
 * @property integer $country_from_id
 * @property integer $city_from_id
 * @property integer $user_application_id
 * @property integer $date_create
 * @property integer $date_update
 * @property integer $tourfirm_id
 * @property integer $user_id
 */
class ApplicationForTours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%application_for_tours}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ApplicationForToursQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ApplicationForToursQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_to_id', 'city_to_id', 'date', 'price', 'adults', 'country_from_id', 'city_from_id', 'user_application_id', 'days', 'nights','tourfirm_id','user_id', 'manager_id','transport_type'], 'required'],
            [['country_to_id', 'city_to_id', 'price', 'adults', 'childrens', 'country_from_id', 'city_from_id', 'user_application_id', 'date_create', 'date_update','user_id'], 'integer'],
            [['date'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => new Expression(time()),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_to_id' => 'Country To ID',
            'city_to_id' => 'City To ID',
            'date' => 'Date',
            'price' => 'Price',
            'adults' => 'Adults',
            'childrens' => 'Childrens',
            'country_from_id' => 'Country From ID',
            'city_from_id' => 'City From ID',
            'user_application_id' => 'User Application ID',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(), ['country_id'=>'country_to_id']);
    }
    public function getCity(){
        return $this->hasOne(Cities::className(), ['id'=>'city_to_id']);
    }
    public function getFromCity(){
        return $this->hasOne(Cities::className(), ['id'=>'city_from_id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'manager_id']);
    }
    public function getTransport(){
        return $this->hasOne(Transports::className(), ['id'=>'transport_type']);
    }
}
