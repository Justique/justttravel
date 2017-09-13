<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "{{%tourfirms_reviews}}".
 *
 * @property integer $id
 * @property string $comment
 * @property integer $user_id
 * @property integer $vote
 * @property integer $tourfirm_id
 * @property integer $date_create
 */
class TourfirmsReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $updated_at;
    public $slug;
    public $tourfirm_vote;
    public $thumbnail;

    public $testChexbox;

    public static function tableName()
    {
        return '{{%tourfirms_reviews}}';
    }

    public static function updateStatus($id, $s){
        $model = new self;
        if($model->updateAll(['status'=>$s], ['id'=>$id])){
            return true;
        }
        else {
            return false;
        }


    }

    /**
     * @inheritdoc
     * @return \common\models\query\TourfirmsReviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourfirmsReviewsQuery(get_called_class());
    }

    public function behaviors()
    {

        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'value' => new Expression(time()),
            ],
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'thumbnail',
                'pathAttribute' => 'thumbnail_path',
                'baseUrlAttribute' => 'thumbnail_base_url'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tourfirm_id','user_id', 'vote'], 'required'],
            [['user_id', 'tourfirm_id', 'date_create','status', 'vote'], 'integer'],
            [['comment'], 'string', 'max' => 255],
            [['thumbnail','thumbnail_path', 'thumbnail_base_url'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Комментарий',
            'user_id' => 'Пользователь',
            'tourfirm_id' => 'Турфирма',
            'status' => 'Статус',
            'date_create' => 'Дата',
            'vote' => 'Оценка',
            'thumbnail' => 'Картинка',
        ];
    }

    public function getUser(){
        return $this->hasOne(UserProfile::className(), ['user_id'=>'user_id']);
    }

    public function getUserName(){
        return $this->user->firstname;
    }


    public function getComments() {
        return $this->hasMany(ReviewsComment::className(), ['reviews_id'=>'id']);
    }

    public function getTourfirm() {
        return $this->hasOne(Tourfirms::className(), ['id'=>'tourfirm_id']);
    }
    public function getVotes() {
        return $this->hasMany(TourfirmVotes::className(), ['review_id'=> 'id']);
    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        Tourfirms::getTourfirmVotes($this->tourfirm_id);
    }
}
