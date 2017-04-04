<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%managers_phone}}".
 *
 * @property integer $id
 * @property integer $manager_id
 * @property string $default
 * @property string $life
 * @property string $mts
 * @property string $viber
 * @property string $skype
 * @property string $icq
 *
 * @property User $manager
 */
class ManagersPhone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%managers_phone}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id'], 'required'],
            [['manager_id'], 'integer'],
            [['default', 'life', 'mts', 'viber', 'skype', 'icq'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manager_id' => 'Manager ID',
            'default' => 'Phone - Default',
            'life' => 'Phone - Life',
            'mts' => 'Phone - Mts',
            'viber' => 'Phone - Viber',
            'skype' => 'Phone - Skype',
            'icq' => 'Icq',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(User::className(), ['id' => 'manager_id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\ManagersPhoneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ManagersPhoneQuery(get_called_class());
    }

    public static function savePhoneManager($model, $post, $manager_id){
        $model->manager_id = $manager_id;
        $model->default = $post['ManagersPhone']['default'];
        $model->life =  $post['ManagersPhone']['life'];
        $model->mts =  $post['ManagersPhone']['mts'];
        $model->viber =  $post['ManagersPhone']['viber'];
        $model->skype =  $post['ManagersPhone']['skype'];
        $model->icq =  $post['ManagersPhone']['icq'];
        $model->save();
    }

    public static function updatePhoneManager($model, $id, $post)
    {
        if ($id) {
            $model->updateAll(
                [
                    'default' => $post['ManagersPhone']['default'],
                    'life'=>  $post['ManagersPhone']['life'],
                    'mts' =>  $post['ManagersPhone']['mts'],
                    'viber' =>  $post['ManagersPhone']['viber'],
                    'skype' => $post['ManagersPhone']['skype'],
                    'icq' =>  $post['ManagersPhone']['icq'],
                ],
                ['manager_id' => $id]
            );
        }


    }
}
