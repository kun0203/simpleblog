<?php
/**
 * Created by PhpStorm.
 * User: Kun Flórián
 * Date: 2020. 01. 18.
 * Time: 10:29
 */

namespace app\models;


use yii\base\Model;
use yii\helpers\VarDumper;

class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_repeat'], 'required', 'message'=>'Kötelező kitölteni'],
            [['username'], 'string', 'min' => 4, 'max' => 64],
            [['email'], 'email', 'message'=>'Adjon meg egy helyes email címet'],
            [['password'], 'string', 'min' => 6, 'max' => 64, 'message'=>'Legalább 6 karakter hosszú legyen'],
            [['password'], 'match', 'pattern'=>'/\d/', 'message'=>'Legalább 1 számot tartalmaznia kell'],
            [['password_repeat'], 'string', 'min' => 6, 'max' => 255],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message'=>'A jelszavaknak egyezniük kell']
        ];
    }

    public function regist(){
        $user = new User();
        $user -> username = \yii\helpers\Html::encode($this->username);
        $user -> email = \yii\helpers\Html::encode($this->email);
        $user -> password = \Yii::$app->security->generatePasswordHash($this->password);
        $user -> access_token = \Yii::$app->security->generateRandomString();
        $user -> auth_key = \Yii::$app->security->generateRandomString();
        if($user -> save()){
            return true;
        }
        \Yii::$app->session->setFlash('error', 'A felhasználónév vagy email már foglalt!');
        \Yii::error("Felhasználó mentése sikertelen" . VarDumper::dumpAsString($user->errors));
        return false;
    }
}