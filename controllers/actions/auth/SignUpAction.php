<?php


namespace app\controllers\actions\auth;


use app\base\BaseAction;
use app\models\Users;

class SignUpAction extends BaseAction
{

    public function run()
    {
        $model = new Users();

        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());

            if($this->controller->auth->signUp($model)) {
                $this->controller->goBack();
            }
        }

        return $this->controller->render('signup',['model'=>$model]);
    }

}