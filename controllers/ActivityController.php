<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\activity\CreateAction;

class ActivityController extends BaseController
{

    public function actions()
    {
        return [
            'create'=>['class'=>CreateAction::class,'name' => 'Artem'],
            'new'=>['class'=>CreateAction::class,'name' => 'Pavel']
        ];
    }

//    public function actionCreate()
//    {
//        return $this->render('create');
//    }
}