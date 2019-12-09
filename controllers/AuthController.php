<?php


namespace app\controllers;


use app\controllers\actions\auth\SignUpAction;
use app\controllers\actions\auth\SignInAction;
use yii\web\Controller;

class AuthController extends Controller
{
    /* @var AuthComponent*/
    public $auth;
    public function __construct($id, $controller, $config = [])
    {
        parent::__construct($id, $controller, $config);
        $this->auth=\Yii::$app->auth;
    }

    public function actions()
    {
        return [
            'sign-up'=>['class'=>SignUpAction::class],
            'sign-in'=>['class'=>SignInAction::class]
        ];
    }

}