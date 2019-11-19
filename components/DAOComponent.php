<?php


namespace app\components;


use app\base\BaseComponent;
use yii\db\Connection;
use app\models\Activity;

class DAOComponent extends BaseComponent
{
    private function getConnection(): Connection
    {
        return \Yii::$app->db;
    }

    // TODO изменить привязку email/пользователя
    public function insertActivity(Activity $activity)
    {
        $i=$this->getConnection()
            ->createCommand()
            ->insert('activity',[
                'title'=>$activity->title,
                'description'=>$activity->description,
//                'files'=>json_encode($activity->files),
                'startDateTime'=>$activity->startDateTime,
                'endDateTime'=>$activity->endDateTime,
                'isBlocked'=>$activity->isBlocked,
                'userId'=>1
            ])
            ->execute();

        $activity->ind = 1;
        return $i;
    }

}