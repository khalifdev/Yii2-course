<?php

namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;
use yii\web\UploadedFile;

class ActivityComponent extends BaseComponent
{
    public $modelClass;

    public function getModel()
    {
        return new $this->modelClass;
    }

    public function addActivity(Activity $activity) : bool
    {
        // валидация формы
        if ($activity->validate()) {

            // проверка наличия и сохранение файлов
            if ($activity->files) {
                $activity->files = \Yii::$app->file->saveFiles($activity->files);
                if (!$activity->files) {
                    return false;
                }
                $activity->files = json_encode($activity->files);
            }
            if (\Yii::$app->dao->insertActivity($activity)) {
                return true;
            }
            return false;
        }
        // если валидация формы не прошла
        return false;
    }

    public function findTodayNotifActivity(){
        return Activity::find()->andWhere('useNotification=1')
            ->andWhere('startDateTime>=:date',[':date' => date('Y-m-d')])
            ->andWhere('startDateTime<=:date1',[':date1' => date('Y-m-d').' 23:59:59'])->all();
    }
}