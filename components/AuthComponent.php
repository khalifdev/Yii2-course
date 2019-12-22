<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Users;

class AuthComponent extends BaseComponent
{

    public function signIn(Users $model) : bool
    {
        $model->scenarioSignIn();

        if(!$model->validate(['email','password'])){
            return false;
        }

        $user = $this->getUserByEmail($model->email);

        if(!$this->validatePassword($model->password, $user->passwordHash)){
            $model->addError('password', 'Неверный пароль');
            return false;
        }

        return \Yii::$app->user->login($user);
    }

    public function signUp(Users $model) : bool
    {
        $model->scenarioSignUp();
        if(!$model->validate(['email','password'])){
            return false;
        }

        $model->passwordHash = $this->genPasswordHash($model->password);

        if($model->save()){
            return \Yii::$app->user->login($model);
        }
        return false;
    }

    public function genPasswordHash(string $password)
    {
        return \Yii::$app->security->generatePasswordHash($password);
    }


    public function getUserByEmail($email): ? Users
    {
        return Users::find()->andWhere(['email'=>$email])->one();
    }

    public function validatePassword($password, $passwordHash):bool
    {
        return \Yii::$app->security->validatePassword($password, $passwordHash);
    }
}