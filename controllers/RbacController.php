<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\RbacInitComponent;

class RbacController extends BaseController
{
    public function actionGen(){
        $rbacObj = new RbacInitComponent();
        $rbacObj->generateRbac();
    }

}