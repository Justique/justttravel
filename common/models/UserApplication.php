<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%user_application}}".
 *
 * @property integer $id
 * @property integer $country_id
 * @property integer $city_id
 * @property integer $resort_city
 * @property string $date
 * @property integer $price
 * @property integer $adults
 * @property integer $childrens
 * @property integer $country_from_id
 * @property integer $shopping_city
 * @property integer $user_id
 * @property integer $date_create
 * @property string $comment
 * @property integer $is_active
 * @property string $hotels
 */
class UserApplication extends \yii\db\ActiveRecord
{
    public $published_at;

    public static function tableName()
    {
        return '{{%user_application}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\UserApplicationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\UserApplicationQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */

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
    public function rules()
    {
        return [
            [['country_id', 'city_id', 'resort_city', 'date', 'price', 'adults', 'country_from_id', 'shopping_city', 'user_id','transport_type', 'days','nights'], 'required'],
            [['country_id', 'city_id', 'resort_city', 'price', 'adults', 'childrens', 'country_from_id', 'shopping_city', 'user_id', 'date_create','date_update', 'is_active'], 'integer'],
            [['comment', 'hotels'], 'string'],
            [['date'], 'string', 'max' => 255]
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
            'city_id' => 'City ID',
            'resort_city' => 'Resort City',
            'date' => 'Date',
            'price' => 'Price',
            'adults' => 'Adults',
            'childrens' => 'Childrens',
            'country_from_id' => 'Country From ID',
            'shopping_city' => 'Shopping City',
            'user_id' => 'User ID',
            'date_create' => 'Date Create',
            'comment' => 'Ваши пожелания',
            'hotels' => 'Отели',
            'is_active' => 'Is Active',
        ];
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(), ['country_id'=>'country_id']);
    }
    public function getCity(){
        return $this->hasOne(Cities::className(), ['id'=>'city_id']);
    }
    public function getShoppingCity(){
        return $this->hasOne(Cities::className(), ['id'=>'shopping_city']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
    public function getTransport(){
        return $this->hasOne(Transports::className(), ['id'=>'transport_type']);
    }


}
