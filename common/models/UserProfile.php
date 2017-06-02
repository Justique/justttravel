<?php

namespace common\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use frontend\helpers\PaymentHelper;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property integer $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $gender
 * @property integer $tariff
 *
 * @property User $user
 */
class UserProfile extends \yii\db\ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    public $picture;
    public $tariff;
    public $user_fullname;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    public static function saveManager($id){
        $model = new UserProfile();
        $model->user_id = $id;
        $model->locale = 'ru-RU';
        $model->save();
    }

    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::className(),
                'attribute' => 'picture',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ]
        ];
    }

    public function setUserfullname(){
        $this->user_fullname = $this->fullName;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'gender', 'tariff'], 'integer'],
            [['gender'], 'in', 'range'=>[NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url','company', 'ur_address', 'address','phone','fullname'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => 'ru-RU'],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            ['picture', 'safe'],
            [['bday','bmonth','byear','country','city','locale'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'Middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'locale' => Yii::t('common', 'Locale'),
            'picture' => Yii::t('common', 'Picture'),
            'gender' => Yii::t('common', 'Gender'),
        ];
    }

    public function attributes() {
        return array_merge(parent::attributes(), [
            'tariff',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord && $this->user->type == User::TOUR_OPERATOR) {
                $tariff = new UserTariff();
                $tariff->user_id = $this->user_id;
                $tariff->tariff_id = 1;
                $tariff->save();

                // добавляем тариф к оплате
                $trf = Tariffs::findOne(['id' => $this->tariff]);
                if ($trf) {
                    PaymentHelper::add(Payment::TYPE_TARIFF, $this->tariff, $this->user_id);
                }
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Yii::$app->session->setFlash('forceUpdateLocale');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getFullName()
    {
        if ($this->firstname || $this->lastname) {
            return implode(' ', [$this->firstname, $this->lastname]);
        }
        return null;
    }

    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : $default;
    }

    public function getCitySelect(){
        $city = Cities::find()->where(['id'=>$this->city])->one();
        return $city;
    }

    public function getCity(){
        return $this->hasOne(Cities::className(),'id','city');
    }

    public function getCountry(){
        return $this->hasOne(Countries::className(),'country','country_id');
    }
}
