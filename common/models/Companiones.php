<?php

namespace common\models;

use frontend\components\MyTaggableBehavior;
use Yii;

/**
 * This is the model class for table "tbl_companiones".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $age_with
 * @property integer $age_to
 * @property integer $type_travel_id
 * @property string $purpose_travel
 * @property string $about_me
 * @property string $about_traveler
 * @property string $travel_location
 */
class Companiones extends \yii\db\ActiveRecord
{
    public $qwer;

    public $interest;
    public $iterests;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_companiones';
    }

    public static function updateCompanionesCompany($id, $post)
    {
        if ($id) {
            $model = new CompanionesCompany();
            $model->updateAll(
                [
                    'man' => $post['man'],
                    'woman' => $post['woman'],
                    'company' => $post['company'],
                ],
                ['companion_id' => $id]
            );
        }


    }

    public static function getClassGender($gender) {
        if($gender == 1) {
            return 'violet';
        }
        elseif($gender == 2){
            return 'blue';
        }
    }

//    public function afterSave($insert, $changedAttributes)
//    {
//        parent::afterSave($insert, $changedAttributes);
//        if ($insert && yii::$app->request->post()) {
//            $model = new CompanionesCompany();
//            dump(yii::$app->request->post());
//            $model->company = yii::$app->request->post('CompanionesCompany')['company'];
//            $model->companion_id = yii::$app->db->lastInsertID;
//            $model->save();
//        }
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'age_with', 'age_to', 'type_travel_id'], 'integer'],
            [['purpose_travel', 'about_me', 'about_traveler', 'travel_location', 'gender_traveler'], 'string', 'max' => 200],
            [['purpose_travel', 'about_me', 'about_traveler', 'travel_location'], 'required'],
            [['editorTags'], 'safe']
        ];
    }

    public function behaviors()
    {
        return [
            'taggable' => [
                'class' => MyTaggableBehavior::className(),
                'tagClass' => Interests::className(),
                'junctionTable' => '{{%companiones_interests}}',
            ]
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
            'age_with' => 'Возраст попутчика (с)',
            'age_to' => 'Возраст попутчика (до)',
            'type_travel_id' => 'Type Travel ID',
            'purpose_travel' => 'Цель поездки',
            'about_me' => 'Про меня',
            'about_traveler' => 'Про попутчика',
            'travel_location' => 'Куда вы планируете поехать',
            'iterests' => 'Интересы',
            'gender_traveler' => 'Ищу в попутчики',
        ];
    }

    public function getGender(){
        return $this->hasOne(CompanionesGender::className(), ['id' => 'gender_traveler']);
    }

    public function getMyCompaniones()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'user_id']);
    }
}
