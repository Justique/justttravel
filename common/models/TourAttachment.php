<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tour_attachment}}".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $path
 * @property string $base_url
 * @property string $type
 * @property integer $size
 * @property string $name
 * @property integer $create_at
 * @property integer $order
 */
class TourAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tour_attachment}}';
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TourAttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TourAttachmentQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'path', 'base_url', 'type', 'size', 'name'], 'required'],
            [['tour_id', 'size', 'create_at', 'order'], 'integer'],
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
            'tour_id' => 'Tour ID',
            'path' => 'Path',
            'base_url' => 'Base Url',
            'type' => 'Type',
            'size' => 'Size',
            'name' => 'Name',
            'create_at' => 'Create At',
            'order' => 'Order',
        ];
    }
}
