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
    public $body;
    public $phone;
    public $conditions;
    public $reCaptcha;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            ['phone', 'required'],

            ['email', 'email'],

            [['name', 'body'],'string'],

            ['conditions', 'required', 'requiredValue' => true, 'message'=>'Необходимо согласие с Условиями' ],
            
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className()]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'body' => 'Сообщение',
            'reCaptcha' => 'Проверка',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        if(Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom('noreply@kovkasnab.ru')
            ->setSubject("Обратная связь с сайта: ".$this->phone)
            ->setTextBody("Имя: " . $this->name . "\n Емэйл: " . $this->email . "\n Телефон: " . $this->phone . "\n Сообщение: " . $this->body)
            ->send())
            return true;
        else
            return false;
    }
}
