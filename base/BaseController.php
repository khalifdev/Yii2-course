<?php


namespace app\base;


use yii\web\Controller;

class BaseController extends Controller
{

    public function beforeAction($action)
    {
        $this->view->params['lastPage'] = \Yii::$app->session->getFlash('lastPage');
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('lastPage',\Yii::$app->request->url);
        return parent::afterAction($action, $result);
    }
}