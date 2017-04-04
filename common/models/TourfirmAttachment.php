<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%tourfirm_attachment}}".
 *
 * @property integer $id
 * @property integer $tourfirm_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property string $name
 * @property integer $size
 * @property integer $created_at
 * @property integer $order
 *
 * @property Tourfirms $tourfirm
 */
class TourfirmAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tourfirm_attachment}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tourfirm_id'], 'required'],
            [['tourfirm_id', 'size', 'created_at', 'order'], 'integer'],
            [['path', 'base_url', 'type', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tourfirm_id' => 'Tourfirm ID',
            'path' => 'Path',
            'base_url' => 'Base Url',
            'type' => 'Type',
            'name' => 'Name',
            'size' => 'Size',
            'created_at' => 'Created At',
            'order' => 'Order',
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
     * @return \common\models\query\TourfirmAttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourfirmAttachmentQuery(get_called_class());
    }


    public function getUrl()
    {
        return $this->base_url .'/'. $this->path;
    }
}
