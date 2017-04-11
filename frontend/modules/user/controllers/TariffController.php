<?php

namespace frontend\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use frontend\helpers\PaymentHelper;
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
            /** @var \common\models\UserTariff $tariff */
            $tariff = userModel()->tariff;
            if (strtotime('+1 month', $tariff->activated_at) > time()) {
                Yii::$app->session->setFlash('canNotChangeTariff');
            } else {
                $this->addPayment(Payment::TYPE_TARIFF, Yii::$app->request->post('tariff'));
            }
        }

        if (Yii::$app->request->post('time')) {
            $this->addPayment(Payment::TYPE_TARIFF_EXTENSION, Yii::$app->request->post('time'));
        }

        $payment_total = 0;
        $to_pay = Payment::findAll(['user_id' => userModel()->id, 'status' => Payment::STATUS_TO_PAY]);
        if ($to_pay) {
            foreach ($to_pay as $payment) {
                $payment_total += $payment->total;
            }
        }

        $payments = Payment::find()
            ->where(['user_id' => userModel()->id])
            ->andWhere('status > ' . Payment::STATUS_TO_PAY)
            ->all();

        return $this->render('index', [
            'tariffs' => ArrayHelper::map(Tariffs::find()->where('id != ' . userModel()->tariff->tariff_id)->all(), 'id', 'name'),
            'user_tariff' => userModel()->tariff,
            'to_pay' => $to_pay,
            'payment_total' => $payment_total,
            'payments' => $payments,
        ]);
    }

    public function actionPay()
    {
        $pending_payments = Payment::find()
            ->where(['user_id' => userModel()->id])
            ->andWhere(['status' => [Payment::STATUS_PENDING_PAYMENT, Payment::STATUS_PARTIALLY_PAID]])
            ->all();
        if ($pending_payments) {
            Yii::$app->session->setFlash('existUnpaidInvoice');
        } else {
            $payments = Payment::findAll(['user_id' => userModel()->id, 'status' => Payment::STATUS_TO_PAY]);
            if ($payments) {
                foreach ($payments as $payment) {
                    /** @var \common\components\expressPay\Merchant $merchant */
                    $merchant = Yii::$app->get('expressPay');
                    $invoice = $merchant->addInvoice($payment->total);
                    if ($invoice) {
                        $payment->invoice_id = $invoice;
                        $payment->status = Payment::STATUS_PENDING_PAYMENT;
                        $payment->save();
                    }
                    /*if ($payment->type == Payment::TYPE_TARIFF) {
                        /** @var \common\models\UserTariff $user_tariff */
                    /*$user_tariff = userModel()->tariff;
                    $user_tariff->tariff_id = $payment->tariff_id;
                    $user_tariff->activated_at = time();
                    $user_tariff->valid_at = strtotime('+1 month');
                    $user_tariff->save();
                    $payment->delete();
                } elseif ($payment->type == Payment::TYPE_TARIFF_EXTENSION) {
                    /** @var \common\models\UserTariff $user_tariff */
                    /*$user_tariff = userModel()->tariff;
                    $user_tariff->valid_at =
                        strtotime(
                            date('Y-m-d H:i:s', $user_tariff->valid_at) .
                            ' +' .
                            $payment->month_count .
                            ' month'
                        );
                    $user_tariff->save();
                    $payment->delete();
                }*/
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
        PaymentHelper::add($type, $data);
        return $this->redirect(['index']);
    }
}