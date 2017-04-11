<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%payment}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property integer $tariff_id
 * @property integer $month_count
 * @property string $name
 * @property integer $price
 * @property integer $discount
 * @property double $total
 * @property integer $payment_at
 * @property integer $invoice_id
 * @property integer $status
 */
class Payment extends \yii\db\ActiveRecord
{
    const TYPE_TARIFF = 0;
    const TYPE_TARIFF_EXTENSION = 1;
    public static $typeList = [
        self::TYPE_TARIFF => 'Оплата тарифа',
        self::TYPE_TARIFF_EXTENSION => 'Продление тарифа',
    ];

    const STATUS_TO_PAY = 0;
    const STATUS_PENDING_PAYMENT = 1;
    const STATUS_OVERDUE = 2;
    const STATUS_PAID = 3;
    const STATUS_PARTIALLY_PAID = 4;
    const STATUS_CANCELED = 5;
    public static $statusList = [
        self::STATUS_TO_PAY => 'К оплате',
        self::STATUS_PENDING_PAYMENT => 'Ожидает оплату',
        self::STATUS_OVERDUE => 'Просрочен',
        self::STATUS_PAID => 'Оплачен',
        self::STATUS_PARTIALLY_PAID  => 'Оплачен частично',
        self::STATUS_CANCELED  => 'Отменен',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'name', 'price', 'total'], 'required'],
            [['type', 'user_id', 'tariff_id', 'month_count', 'price', 'discount', 'payment_at', 'invoice_id', 'status'], 'integer'],
            [['total'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'user_id' => 'User ID',
            'tariff_id' => 'Tariff ID',
            'month_count' => 'Month Count',
            'name' => 'Name',
            'price' => 'Price',
            'discount' => 'Discount',
            'total' => 'Total',
            'payment_at' => 'Payment At',
            'invoice_id' => 'Invoice ID',
            'status' => 'Status',
        ];
    }
}
