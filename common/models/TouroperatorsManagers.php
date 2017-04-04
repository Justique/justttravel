<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%touroperators_managers}}".
 *
 * @property integer $manager_id
 * @property integer $profile_touroperator_id
 * @property integer $profile_manager_id
 *
 * @property User $profileManager
 * @property User $profileTouroperator
 */
class TouroperatorsManagers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%touroperators_managers}}';
    }

    public static function saveUsersManagers($profile_touroperator_id, $profile_manager_id){
        if($profile_touroperator_id && $profile_manager_id){
            $model = new TouroperatorsManagers();
            $model->profile_touroperator_id = $profile_touroperator_id;
            $model->profile_manager_id = $profile_manager_id;
            $model->save();
        }
    }

    public static function getAllManagerId($touroprator_id){
        $model = TouroperatorsManagers::find()->where(['profile_touroperator_id'=>$touroprator_id])->all();
        $ids = [];
        foreach($model as $item){
            $ids[] = $item->profile_manager_id;
        }
        return $ids;
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TouroperatorsManagersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TouroperatorsManagersQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_touroperator_id', 'profile_manager_id'], 'required'],
            [['profile_touroperator_id', 'profile_manager_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manager_id' => 'Manager ID',
            'profile_touroperator_id' => 'Profile Touroperator ID',
            'profile_manager_id' => 'Profile Manager ID',
        ];
    }

    public function getTourfirm() {
        return $this->hasOne(Tourfirms::className(), ['touroperator_id' => 'profile_touroperator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileManager()
    {
        return $this->hasOne(UserProfile::className(), ['user_id' => 'profile_manager_id']);
    }

    public function getManagerPhones(){
        return $this->hasOne(ManagersPhone::className(), ['manager_id' => 'profile_manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileTouroperator()
    {
        return $this->hasOne(User::className(), ['id' => 'profile_touroperator_id']);
    }
}
