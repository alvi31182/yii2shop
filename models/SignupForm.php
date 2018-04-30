<?php
/**
 * Created by PhpStorm.
 * User: ahala
 * Date: 30.04.2018
 * Time: 17:02
 */

namespace app\models;
use yii\base\Model;
use Yii;

/*
 * SignupForm
 */
class SignupForm extends model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */

    public  function rules(){
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['email', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Пользователь с таким именем уже есть.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email','required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой email уже существует.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

    public function signUp(){
        if(!$this->validate()){
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey($user->auth_key);
        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Почта',
            'password' => 'Пароль',
        ];
    }
}