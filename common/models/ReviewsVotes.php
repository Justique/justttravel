<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%reviews_votes}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $reviews_id
 * @property integer $vote
 *
 * @property TourfirmsReviews $reviews
 */
class ReviewsVotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reviews_votes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'reviews_id', 'vote'], 'required'],
            [['user_id', 'reviews_id', 'vote'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'reviews_id' => 'Reviews ID',
            'vote' => 'Vote',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasOne(TourfirmsReviews::className(), ['id' => 'reviews_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ReviewsVotesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ReviewsVotesQuery(get_called_class());
    }

    public static function saveVotes($param){
        $model = new ReviewsVotes();
        $model->vote = $param['vote'];
        $model->reviews_id = $param['reviews_id'];
        $model->user_id = $param['user_id'];
        if($model->save()){
            return true;
        }

    }

    public static function getCountVotes($status, $reviews_id){
        $model = ReviewsVotes::find()->where(['vote'=>$status, 'reviews_id'=>$reviews_id])->all();
        return count($model);
    }
}
