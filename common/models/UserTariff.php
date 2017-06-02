<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_tariff}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $tariff_id
 * @property string $valid_at
 *
 * @property Tariffs $tariff
 * @property User $user
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
            [['user_id', 'tariff_id'], 'integer'],
            [['valid_at'], 'safe'],
            [['user_id'], 'unique'],
            [['tariff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tariffs::className(), 'targetAttribute' => ['tariff_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'tariff_id' => 'Тариф',
            'valid_at' => 'Действует до',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getTariff()
    {
        return $this->hasOne(Tariffs::className(), ['id' => 'tariff_id']);
    }

    public function getUpToursCount()
    {
        return UpTour::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere('FROM_UNIXTIME(timestamp, \'%Y-%m-%d\') = CURDATE()')
            ->count();
    }

    public function getUpVisasCount()
    {
        return UpVisa::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere('FROM_UNIXTIME(timestamp, \'%Y-%m-%d\') = CURDATE()')
            ->count();
    }

    public function getToursCount()
    {
        return Tours::find()
            ->where(['user_id' => $this->user_id])
            ->count();
    }

    public function getVisasCount()
    {
        return Visa::find()
            ->where(['user_id' => $this->user_id])
            ->count();
    }

    public function getNewsCount()
    {
        return Article::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere('FROM_UNIXTIME(created_at, \'%Y-%m-%d\') = CURDATE()')
            ->count();
    }

    public function getResponseCount()
    {
        return ApplicationForTours::find()
            ->where(['user_id' => $this->user_id])
            ->andWhere('FROM_UNIXTIME(date_create, \'%Y-%m-%d\') = CURDATE()')
            ->count();
    }

    public function getManagersCount()
    {
        return TouroperatorsManagers::find()
            ->where(['profile_touroperator_id' => $this->user_id])
            ->count();
    }

    public function canUpTour()
    {
        return $this->getUpToursCount() < $this->tariff->count_up_tours;
    }

    public function canUpVisa()
    {
        return $this->getUpVisasCount() < $this->tariff->count_up_visas;
    }

    public function canCreateTour()
    {
        return $this->tariff->count_tours == Tariffs::INFINITY_NUMBER
            ? true
            : $this->getToursCount() < $this->tariff->count_tours;
    }

    public function canCreateVisa()
    {
        return $this->getVisasCount() < $this->tariff->count_visas;
    }

    public function canCreateNews()
    {
        return $this->getNewsCount() == 0;
    }

    public function canCreateResponse()
    {
        return $this->tariff->count_responses == Tariffs::INFINITY_NUMBER
            ? true
            :$this->getResponseCount() < $this->tariff->count_responses;
    }

    public function canCreateManagers()
    {
        return $this->getManagersCount() < $this->tariff->count_managers;
    }
}
