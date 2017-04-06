<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_tariff}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tariff_id
 * @property integer $activated_at
 * @property integer $valid_at
 *
 * @property User $user
 * @property Tariffs $tariff
 */
class UserTariff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_tariff}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tariff_id'], 'required'],
            [['user_id', 'tariff_id', 'activated_at', 'valid_at'], 'integer'],
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
            'tariff_id' => 'Tariff ID',
            'activated_at' => 'Activated At',
            'valid_at' => 'Valid At',
        ];
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getTariff() {
        return $this->hasOne(Tariffs::className(), ['id' => 'tariff_id']);
    }

    public function getIsActive() {
        if ($this->tariff->price == 0)
            return true;
        else if ($this->activated_at == $this->valid_at)
            return false;
        else
            return time() <= $this->valid_at;
    }

    public function getNewsCount() {
        return Article::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere('FROM_UNIXTIME(created_at, \'%Y-%m-%d\') = CURDATE()')
            ->count();
    }

    public function getResponseCount() {
        return ApplicationForTours::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere('FROM_UNIXTIME(date_create, \'%Y-%m-%d\') = CURDATE()')
            ->count();
    }

    public function getManagersCount() {
        return TouroperatorsManagers::find()
            ->where(['profile_touroperator_id' => $this->user_id])
            ->count();
    }
}
