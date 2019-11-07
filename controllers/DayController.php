<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\day\ShowAction;

class DayController extends BaseController
{
    public function actions()
    {
        return [
            'show'=>['class'=>ShowAction::class]
        ];
    }
}