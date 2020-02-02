<?php
/**
 * Created by PhpStorm.
 * User: Kun Flórián
 * Date: 2020. 01. 20.
 * Time: 10:40
 */

namespace app\models;


use yii\base\Model;
use yii\helpers\VarDumper;

class EditProfileForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $birthday;
    public $introduction;
    public $hometown;


    public function rules(){
        return [
            [['username'], 'string', 'min' => 4, 'max' => 64],
            [['email'], 'required', 'message'=>'Nem lehet üres!'],
            [['email'], 'email', 'message'=>'Adjon meg egy helyes email címet'],
            [['birthday'], 'date',],
            [['introduction'], 'string', 'min' => 4],
            [['hometown'], 'string'],
            [['password'], 'required', 'message'=>'Nem lehet üres!'],
            [['password'], 'string', 'min' => 6, 'max' => 64, 'message'=>'Legalább 6 karakter hosszú legyen'],
            [['password'], 'match', 'pattern'=>'/\d/', 'message'=>'Legalább 1 számot tartalmaznia kell'],
        ];
    }

    public function editProfile(){

        $user = User::findOne([\Yii::$app->user->id]);
        $user -> username = \yii\helpers\Html::encode($this->username);
        $user -> email = \yii\helpers\Html::encode($this->email);
        $user -> password = \Yii::$app->security->generatePasswordHash($this->password);
        if(!empty($this->birthday)){
        $user -> birthday = $this->birthday;}
        $user -> introduction = \yii\helpers\Html::encode($this->introduction);
        $user -> hometown = $this->hometown;
        if($user -> save()){
            return true;
        }
        \Yii::error("Felhasználó mentése sikertelen" . VarDumper::dumpAsString($user->errors));
        return false;
    }
}