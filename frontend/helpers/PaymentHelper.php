<?php

namespace frontend\helpers;

use common\models\Payment;
use common\models\Tariffs;
use common\models\User;

class PaymentHelper
{
    public static function add($type, $data, $user_id = null)
    {
        $tariff = null;
        if ($user_id) {
            $user_model = User::findOne(['id' => $user_id]);
        } else {
            $user_id = userModel()->id;
            $user_model = userModel();
        }
        Payment::deleteAll([
            'user_id' => $user_id,
            'status' => Payment::STATUS_TO_PAY
        ]);
        if ($type == Payment::TYPE_TARIFF) {
            $tariff = Tariffs::findOne(['id' => $data]);
            if ($tariff->price == 0) {
                /** @var \common\models\UserTariff $user_tariff */
                $user_tariff = $user_model->tariff;
                $user_tariff->tariff_id = $tariff->id;
                $user_tariff->activated_at = time();
                $user_tariff->valid_at = time();
                return $user_tariff->save();
            }
        } elseif ($type == Payment::TYPE_TARIFF_EXTENSION) {
            $tariff = $user_model->tariff->tariff;
        }
        $payment = new Payment();
        $payment->type = $type;
        $payment->user_id = $user_id;
        if ($type == Payment::TYPE_TARIFF) {
            $payment->tariff_id = $data;
            $payment->name = 'Тариф “' . $tariff->name . '”';
            $payment->price = $tariff->price;
        } elseif ($type == Payment::TYPE_TARIFF_EXTENSION) {
            $payment->month_count = $data;
            $payment->name = 'Тариф “' . $tariff->name . '” ' . $data . ' месяцев';
            $payment->price = $tariff->price * $data;
            if ($data >= 6 && $data < 12) {
                $payment->discount = getenv('DISCOUNT_6_MONTH');
            } elseif ($data == 12) {
                $payment->discount = getenv('DISCOUNT_12_MONTH');
            }
        }
        $payment->total = $payment->price * ( 100 - $payment->discount ) / 100;
        $payment->status = Payment::STATUS_TO_PAY;
        return $payment->save();
    }
}