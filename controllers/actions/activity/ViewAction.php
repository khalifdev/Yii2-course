<?php


namespace app\controllers\actions\activity;


use app\base\BaseAction;
use app\models\Activity;
use yii\web\HttpException;

class ViewAction extends BaseAction
{


    public function run($id){

        // получаем экземпляр модели активности
        $model = \Yii::$app->activity->getModel();

        $model=Activity::findOne($id);

        if(!\Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403,'Not access to activity');
        }

        if(!$model){
            throw new HttpException(404,'activity not found');
        }

        return $this->controller->render('view',['model'=>$model]);
    }
}