<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tourfirm_votes}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tourfirm_id
 * @property integer $vote
 *
 * @property Tourfirms $tourfirm
 */
class TourfirmVotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tourfirm_votes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tourfirm_id', 'vote'], 'required'],
            [['user_id', 'tourfirm_id', 'vote'], 'integer']
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
            'tourfirm_id' => 'Tourfirm ID',
            'vote' => 'Vote',
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
     * @return \common\models\query\TourfirmVotesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourfirmVotesQuery(get_called_class());
    }

    public static function saveTourfirmVotes($vote, $tourfirm_id){
        $model= new TourfirmVotes();
        $model->tourfirm_id = $tourfirm_id;
        $model->vote = $vote;
        $model->user_id = user()->id;
        $model->save();
    }

    public static function getCountVotes($id){
        $tourfirmVotes = \common\models\TourfirmVotes::find()->where(['tourfirm_id'=>$id])->all();
        if($tourfirmVotes){
            return count($tourfirmVotes);
        }
        else {
            return 0;
        }
    }
}
