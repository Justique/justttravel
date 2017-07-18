<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'body',], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('frontend', 'Имя'),
            'email' => Yii::t('frontend', 'Email'),
            'subject' => Yii::t('frontend', 'Тема'),
            'body' => Yii::t('frontend', 'Сообщение'),
            'verifyCode' => Yii::t('frontend', 'Проверочный код')
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            $message = nl2br($this->body);
            $text = "
                <b>Имя:</b>$this->name<br>
                <b>Email:</b>$this->email<br>
                <b>Текст:</b>$message<br>
                ";
            return Yii::$app->mailer->compose()
                ->setTo($email)
                ->setReplyTo([$this->email => $this->name])
                ->setSubject('Новое сообщение об ошибке')
                ->setHtmlBody($text)
                ->send();
        } else {
            return false;
        }
    }
}
