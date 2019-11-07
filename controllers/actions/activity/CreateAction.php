<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use app\components\ActivityComponent;
use app\models\Activity;

class CreateAction extends BaseAction
{
    public function run()
    {
        $model = \Yii::$app->activity->getModel();

//        \Yii::$app->session->set('sdf','val');
//        \Yii::$app->session->get('sdf','val');

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->activity->addActivity($model)) {

            }
        }

        return $this->controller->render('create', ['model' => $model]);
    }
}