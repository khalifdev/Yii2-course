<?php


namespace app\controllers\actions\auth;


use app\base\BaseAction;
use app\models\Users;

class SignInAction extends BaseAction
{

    public function run()
    {
        $model = new Users();

        if(\Yii::$app->request->isPost){

            $model->load(\Yii::$app->request->post());

            if($this->controller->auth->signIn($model)) {
                $this->controller->goBack();
            }
        }

        return $this->controller->render('signin',['model'=>$model]);
    }

}