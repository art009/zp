<?php

namespace app\widgets\ContactWidget\models;

use app\models\Staff;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $phone;
    public $message;
    public $person;
    public $reCaptcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'phone', 'message'], 'required'],
            ['person','integer'],
            [['reCaptcha'], \app\widgets\GoogleReCaptcha\GoogleReCaptchaValidator::className(), 'uncheckedMessage' => 'Please confirm that you are not a bot.', 'skipOnEmpty' => !Yii::$app->user->isGuest],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha', 'skipOnEmpty' => !Yii::$app->user->isGuest],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'message' => 'Сообщение',
            'reCaptcha' => 'Капча',
            'person' => 'Сотрудник',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            $text_body = 'Клиент: ' . $this->name . PHP_EOL;
            $text_body .= 'Телефон: ' . $this->phone . PHP_EOL;
            $text_body .= 'Сообщение: ' . $this->message . PHP_EOL;
            if ($this->staff)
                $text_body .= 'Записаться к врачу: ' . $this->staff->name . ' ' . $this->staff->position . PHP_EOL;

            $mailer = Yii::$app->mailer->compose()
                ->setFrom([Yii::$app->params['supportEmail'] => 'Robot'])
                ->setSubject('Сообщение с сайта '. Yii::$app->name)
                ->setTextBody($text_body);

            $mails = explode(',',$email);

            foreach ($mails as $mail) {
                $mailer
                    ->setTo( trim($mail) )
                    ->send();
            }

            return true;
        }
        return false;
    }

    public function getStaff()
    {
        if ($this->person) {
            return Staff::findOne($this->person);
        }
        return NULL;
    }
}
