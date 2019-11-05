<?php


namespace app\controllers\actions\activity;


use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;

class CreateAction extends Action
{
    public $name;

    public function run()
    {
        $comp=\Yii::createObject(['class'=>ActivityComponent::class,'modelClass' => Activity::class]);
        $model = \Yii::$app->activity->getModel();
//        $model = $comp->getModel();

//        \Yii::$app->session->set('sdf','val');
//        \Yii::$app->session->get('sdf','val');

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if (\Yii::$app->activity->addActivity($model)) {

            }
        }

        return $this->controller->render('create', ['name' => $this->name, 'model' => $model]);
    }
}