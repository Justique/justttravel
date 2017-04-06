<?php

namespace frontend\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Tariffs;
use common\models\Payment;

class TariffController extends Controller
{
    public $enableCsrfCookie = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'pay' => ['post'],
                    'delete-payment' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = '/profile';

        if (Yii::$app->request->post('tariff')) {
            $this->addPayment(Payment::TYPE_TARIFF, Yii::$app->request->post('tariff'));
        }

        if (Yii::$app->request->post('time')) {
            $this->addPayment(Payment::TYPE_TARIFF_EXTENSION, Yii::$app->request->post('time'));
        }

        $payment_total = 0;
        $payments = Payment::findAll(['user_id' => userModel()->id]);
        if ($payments) {
            foreach ($payments as $payment) {
                $payment_total += $payment->total;
            }
        }

        return $this->render('index', [
            'tariffs' => ArrayHelper::map(Tariffs::find()->where('id != ' . userModel()->tariff->tariff_id)->all(), 'id', 'name'),
            'user_tariff' => userModel()->tariff,
            'payments' => $payments,
            'payment_total' => $payment_total,
        ]);
    }

    public function actionPay()
    {
        $payments = Payment::findAll(['user_id' => userModel()->id]);
        if ($payments) {
            foreach ($payments as $payment) {
                if ($payment->type == Payment::TYPE_TARIFF) {
                    /** @var \common\models\UserTariff $user_tariff */
                    $user_tariff = userModel()->tariff;
                    $user_tariff->tariff_id = $payment->tariff_id;
                    $user_tariff->activated_at = time();
                    $user_tariff->valid_at = strtotime('+1 month');
                    $user_tariff->save();
                    $payment->delete();
                } elseif ($payment->type == Payment::TYPE_TARIFF_EXTENSION) {
                    /** @var \common\models\UserTariff $user_tariff */
                    $user_tariff = userModel()->tariff;
                    $user_tariff->valid_at =
                        strtotime(
                            date('Y-m-d H:i:s', $user_tariff->valid_at) .
                            ' +' .
                            $payment->month_count .
                            ' month'
                        );
                    $user_tariff->save();
                    $payment->delete();
                }
            }
        }
        return $this->redirect(['index']);
    }

    public function actionDeletePayment($id)
    {
        $payment = Payment::findOne(['id' => $id]);
        if ($payment && $payment->user_id == userModel()->id) {
            $payment->delete();
        }
        return $this->redirect(['index']);
    }

    private function addPayment($type, $data)
    {
        $tariff = null;
        $user_id = userModel()->id;
        Payment::deleteAll(['user_id' => $user_id]);
        if ($type == Payment::TYPE_TARIFF) {
            $tariff = Tariffs::findOne(['id' => $data]);
            if ($tariff->price == 0) {
                /** @var \common\models\UserTariff $user_tariff */
                $user_tariff = userModel()->tariff;
                $user_tariff->tariff_id = $tariff->id;
                $user_tariff->activated_at = time();
                $user_tariff->valid_at = time();
                $user_tariff->save();
                return $this->redirect(['index']);
            }
        } elseif ($type == Payment::TYPE_TARIFF_EXTENSION) {
            $tariff = userModel()->tariff->tariff;
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
        $payment->total = $payment->price * ( 100 - $payment->discount ) / 100;;
        $payment->save();
        return $this->redirect(['index']);
    }
}