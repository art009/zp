<?php
namespace app\widgets\SignUpWidget\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $sex;
    public $phone;
//    public $photo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Данный пользователь зарегистрирован!'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Данный E-mail уже зарегистрирован!'],
            ['sex', 'in', 'range' => [User::SEX_MALE, User::SEX_FEMALE]],
            [
                'phone',
                'match',
                'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/',
                'message' => 'Номер телефона должен соответствовать формату: +7(111)111-11-11',
            ],

            ['phone', 'filter', 'filter' => function ($value) {
                $value = preg_replace("/[^0-9]/", "", $value);

                if (strlen($value) === 11) {
                    $value = preg_replace("/^8/", "7", $value);
                }
                return $value;
            }],
//            ['photo', 'safe'],

            [['password', 'password_repeat'], 'required'],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'username' => 'Ваше имя',
            'email' => 'Email',
            'sex' => 'Пол',
            'password' => 'Пароль',
            'password_repeat' => 'Повторить пароль',
            'phone' => 'Тел. номер',
//            'photo' => Yii::t('users', 'PHOTO'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->status = User::STATUS_NEW;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }

}
