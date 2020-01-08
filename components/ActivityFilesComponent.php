<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;

class ActivityFilesComponent extends BaseComponent
{

    public function addFiles(Activity $activity) : bool
    {

            // проверка наличия и сохранение файлов
            if ($activity->files) {

                $activity->files = \Yii::$app->file->saveFiles($activity->files);

                if (!$activity->files) {
                    return false;
                }

                $activity->files = json_encode($activity->files);
            }
            return true;

    }


}