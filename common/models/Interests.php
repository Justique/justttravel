<?php

namespace common\models;

use sjaakp\taggable\TagBehavior;
use Yii;

/**
 * This is the model class for table "{{%interests}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $count
 */
class Interests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%interests}}';
    }

    public static function getUniqInterests() {
        $companiones = Companiones::find()->all();
        $comp_ids = [];
        foreach($companiones as $id){
            $comp_ids[] =  $id->id;
        }
        $companiones_interests = CompanionesInterests::find()->where(['companion_id'=>$comp_ids])->all();
        $interest_id = [];
        foreach($companiones_interests as $id){
            $interest_id[] =  $id->interest_id;
        }
        $model = self::find()->where(['id'=>$interest_id])->all();
        $uniq = [];
        foreach($model as $interest){
            if(!in_array($interest->name, $uniq)){
                $uniq[$interest->id] = $interest->name;
            }
        }
        return $uniq;
    }

    /**
     * @inheritdoc
     * @return \common\models\query\InterestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\InterestsQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            'tag' => [
                'class' => TagBehavior::className(),
                'junctionTable' => '{{%companiones_interests}}',
            ]
        ];
    }

    public function getCompaniones() {
        return $this->hasMany(CompanionesInterests::className(), [ 'interest_id' => 'id' ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'count' => 'Count',
        ];
    }
}
