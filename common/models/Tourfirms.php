<?php

namespace common\models;

use common\models\query\TourfirmsQuery;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;


/**
 * This is the model class for table "tbl_tourfirms".
 *
 * @property integer $id
 * @property float $rating
 * @property string $description
 * @property string $address
 * @property string $name
 * @property string $phone
 */
class Tourfirms extends \yii\db\ActiveRecord
{
    public $attachments;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tourfirms';
    }

    public static function updateData($id, $post){
        $modelPhons = new TourfirmsPhons();
        $modelPhons->updateAll(
            [
                'default'=>$post['TourfirmsPhons']['default'],
                'mts'=>$post['TourfirmsPhons']['mts'],
                'life'=>$post['TourfirmsPhons']['life'],
                'icq'=>$post['TourfirmsPhons']['icq'],
                'velcom'=>$post['TourfirmsPhons']['velcom'],
            ],
            [
                'tourfirm_id'=>$id
            ]
        );
        $modelWorkTime = new TourfirmWorkTime();
        $modelWorkTime->updateAll(
            [
                'monday'=>$post['TourfirmWorkTime']['monday'],
                'tuesday'=>$post['TourfirmWorkTime']['tuesday'],
                'wednesday'=>$post['TourfirmWorkTime']['wednesday'],
                'thursday'=>$post['TourfirmWorkTime']['thursday'],
                'friday'=>$post['TourfirmWorkTime']['friday'],
                'saturday'=>$post['TourfirmWorkTime']['saturday'],
                'sunday'=>$post['TourfirmWorkTime']['sunday'],
            ],
            [
                'tourfirm_id'=>$id
            ]
        );
    }

    public static function getPercentVotes($reviews_id) {
        $model = ReviewsVotes::find()->where(['reviews_id'=>$reviews_id])->all();
        $votes = [];
        if($model) {
            foreach ($model as $vote) {
                if ($vote->vote == 1) {
                    $votes[] = $vote->vote;
                }
            }
            $num = round(count($votes) / count($model) * 5, 2);
            $num = $num . '00000';
            $newNum = substr($num, 0, 4);
            $newNum = substr_replace($newNum, ".", 1, 1);
            return $newNum;
        }
        else{
            return 0;
        }
}

    public static function getTourfirmVotes($tourfirm_id) {
        $model = TourfirmVotes::find()->where(['tourfirm_id'=>$tourfirm_id])->all();
        $tourfirmModel = new Tourfirms();
        $totalVotes = 0;
        if($model){
            foreach($model as $vote){
                $totalVotes += $vote->vote;
            }
        $num = round($totalVotes / count($model), 2);
        $num = $num . '00000';
        $newNum = substr($num, 0, 4);
        $newNum = substr_replace($newNum, ".", 1, 1);
        $tourfirmModel->updateAll(['rating'=>(float)$newNum], ['id'=>$tourfirm_id]);
        return $newNum;
        }

    else{
            return 0;
        }
    }

    public function behaviors()
    {
        return [
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'attachments',
                'multiple' => true,
                'uploadRelation' => 'tourfirmAttachments',
                'pathAttribute' => 'path',
                'baseUrlAttribute' => 'base_url',
                'orderAttribute' => 'order',
                'typeAttribute' => 'type',
                'sizeAttribute' => 'size',
                'nameAttribute' => 'name',
            ],
            [
                'class'=>SluggableBehavior::className(),
                'attribute'=>'name',
                'immutable' => true
            ],
//            [
//                'class' => UploadBehavior::className(),
//                'attribute' => 'thumbnail',
//                'pathAttribute' => 'thumbnail_path',
//                'baseUrlAttribute' => 'thumbnail_base_url'
//            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['touroperator_id', 'radius'], 'integer'],
            [['description','legal_info','slug'], 'string'],
            [['rating'], 'number'],
            [['name'], 'required'],
            [['name'], 'unique'],
            [['address', 'name'], 'string', 'max' => 200],
            [['attachments','longitude', 'latitude'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rating' => 'Рейтинг',
            'description' => 'Описание',
            'address' => 'Адрес',
            'name' => 'Название',
            'phone' => 'Телефон',
            'legal_info' => 'Юридическая информация',
            'country_to_id' => 'Страна',
            'attachments' => 'Картинки',
            'radius' => 'Радиус'
        ];
    }
    public function getTourfirmAttachments()
    {
        return $this->hasMany(TourfirmAttachment::className(), ['tourfirm_id' => 'id']);
    }

    public function getManagers() {
        return $this->hasMany(TouroperatorsManagers::className(), ['profile_touroperator_id'=>'touroperator_id']);
    }

    public function getTours() {
        return $this->hasMany(Tours::className(), ['tourfirm_id'=>'id']);
    }

    public function getTourfirmsPhon(){
        return $this->hasOne(TourfirmsPhons::className(), ['tourfirm_id' =>'id']);
    }

    public function getTourfirmWorkTime(){
        return $this->hasOne(TourfirmWorkTime::className(), ['tourfirm_id' =>'id']);
    }

    public function getTouroperator(){
        return $this->hasOne(User::className(), ['id' => 'touroperator_id']);
    }

    public function getTouroperatorProfile(){
        return $this->hasOne(UserProfile::className(), ['user_id' => 'touroperator_id']);
    }

    public function getTourfirmReviews(){
        return $this->hasMany(TourfirmsReviews::className(), ['tourfirm_id'=>'id'])->andWhere(['status'=>1]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $tourfirmId = self::getTourfirmId(user()->id);
        if ($insert && yii::$app->request->post()) {
            $TourfirmsPhons = new TourfirmsPhons();
            $TourfirmsPhons->tourfirm_id = $tourfirmId;
            $TourfirmsPhons->default = yii::$app->request->post('TourfirmsPhons')['default'];
            $TourfirmsPhons->mts = yii::$app->request->post('TourfirmsPhons')['mts'];
            $TourfirmsPhons->life = yii::$app->request->post('TourfirmsPhons')['life'];
            $TourfirmsPhons->viber = yii::$app->request->post('TourfirmsPhons')['viber'];
            $TourfirmsPhons->skype = yii::$app->request->post('TourfirmsPhons')['skype'];
            $TourfirmsPhons->icq = yii::$app->request->post('TourfirmsPhons')['icq'];
            $TourfirmsWorkTime = new TourfirmWorkTime();
            $TourfirmsWorkTime->tourfirm_id = $tourfirmId;
            $TourfirmsWorkTime->monday = yii::$app->request->post('TourfirmWorkTime')['monday'];
            $TourfirmsWorkTime->tuesday = yii::$app->request->post('TourfirmWorkTime')['tuesday'];
            $TourfirmsWorkTime->wednesday = yii::$app->request->post('TourfirmWorkTime')['wednesday'];
            $TourfirmsWorkTime->thursday = yii::$app->request->post('TourfirmWorkTime')['thursday'];
            $TourfirmsWorkTime->friday = yii::$app->request->post('TourfirmWorkTime')['friday'];
            $TourfirmsWorkTime->saturday = yii::$app->request->post('TourfirmWorkTime')['saturday'];
            $TourfirmsWorkTime->sunday =yii::$app->request->post('TourfirmWorkTime')['sunday'];
            foreach([$TourfirmsPhons, $TourfirmsWorkTime] as $model) {
                $model->save();
            }
        }
    }

    public static function getTourfirmId($id){
        if($id){
            if(userModel()->isUserTourOperator()){
                $userId =  $id;
            }
            else{
                $model = TouroperatorsManagers::find()->where(['profile_manager_id'=>$id])->one();
                $userId = $model->profile_touroperator_id;
            }
            $model = Tourfirms::find()->where(['touroperator_id'=>$userId])->one();
            if($model){
                return $model->id;
            }
            else{
                return false;
            }
        }
    }

    public static function find()
    {
        return new TourfirmsQuery(get_called_class());
    }
}
