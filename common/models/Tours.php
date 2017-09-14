<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use himiklab\sitemap\behaviors\SitemapBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%tours}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $status
 * @property string $price
 * @property integer $country_to_id
 * @property integer $city_to_id
 * @property integer $city_from_id
 * @property string $date_from
 * @property integer $count_old
 * @property integer $count_kids
 * @property integer $hotel_id
 * @property integer $user_id
 * @property string $body
 * @property string $thumbnail_base_url
 * @property string $thumbnail_path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $published_at
 */
class Tours extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $thumbnail;

    public $TourSearchFilter;

    public $Price;

    public $attachments;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tours}}';
    }

    public static function getSmallPrice($object){
        $prices = [];
        if($object){
            foreach ($object as $item) {
                $prices[] = $item->price;
            }
        }
        return min($prices);
    }

    public function behaviors()
    {
        return [
			'sitemap' => [
				'class' => SitemapBehavior::className(),
				'scope' => function ($model) {
					/** @var \yii\db\ActiveQuery $model */
					$model->select(['title', 'slug']);
					
				},
				'dataClosure' => function ($model) {
					/** @var self $model */
					return [
						'loc' => Url::to('tour/'.$model->slug, true),
						'title' => $model->title,
						'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
						'priority' => 0.8
					];
				}
			],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression(time()),
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'tourAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'title',
                'immutable' => false
            ],

            /*[
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'articleAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ]*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $this->published_at = time();
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','price', 'country_to_id', 'city_to_id', 'city_from_id', 'date_from', 'count_old', 'transport_type','user_id', 'body'], 'required'],
            [['country_to_id','country_from_id', 'city_to_id', 'city_from_id', 'count_old', 'count_kids', 'hotel_id', 'user_id','tourfirm_id', 'created_at', 'updated_at', 'published_at', 'hot'], 'integer'],
            [['body'], 'string'],
            [['title'], 'unique'],
            [['title', 'slug', 'status', 'price', 'date_from'], 'string', 'max' => 255],
            [['thumbnail_base_url', 'thumbnail_path'], 'string', 'max' => 1024],
            [['slug','status','user_id','thumbnail_base_url', 'thumbnail_path', 'created_at', 'updated_at', 'published_at', 'count_kids','count_days','count_nights', 'transport_type','attachments'],'safe'],
            [['hotel_title', 'hotel_url'], 'string', 'max' => 255],
            [['hotel_rating'], 'number', 'min' => 0, 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hot' => 'Горящий тур',
            'title' => 'Название тура',
            'slug' => 'URL',
            'status' => 'Статус',
            'price' => 'Стоимость',
            'country_to_id' => 'Страна назначения',
            'city_to_id' => 'Город назначения',
            'city_from_id' => 'Город вылета',
            'date_from' => 'Дата вылета',
            'count_old' => 'Взрослых',
            'count_kids' => 'Детей',
            'hotel_id' => 'Отель',
            'user_id' => 'User ID',
            'body' => 'Описание',
            'thumbnail_base_url' => 'Основная картинка',
            'thumbnail_path' => 'Дополнительные изображения',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'published_at' => 'Published At',
            'attachments' => 'картинки',
            'hotel_title' => 'Название отеля',
            'hotel_url' => 'Ссылка на отель',
            'hotel_rating' => 'Рейтинг отеля',
        ];
    }

    public function getTourAttachments()
    {
        return $this->hasMany(TourAttachment::className(), ['tour_id' => 'id']);
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(), ['country_id'=>'country_to_id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    public function getProfile(){
        return $this->hasOne(UserProfile::className(), ['user_id'=>'user_id']);
    }
    public function getTransport(){
        return $this->hasOne(Transports::className(), ['id'=>'transport_type']);
    }

    public function getCity(){
        return $this->hasOne(Cities::className(), ['id'=>'city_to_id']);
    }

    public function getFromCity(){
        return $this->hasOne(Cities::className(), ['id'=>'city_from_id']);
    }

    public function getContactManager(){
        return $this->hasOne(ManagersPhone::className(), ['manager_id'=>'user_id']);
    }
    
    public function getTourfirm(){
        return $this->hasOne(Tourfirms::className(), ['id'=>'tourfirm_id']);
    }
}
