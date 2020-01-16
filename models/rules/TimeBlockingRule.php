<?php


namespace app\models\rules;


use yii\validators\Validator;

class TimeBlockingRule extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        // запрашиваем блокирующие Активности активного пользователя
        $blockedActivities = \Yii::$app->activity->findBlockedActivities();

        foreach ($blockedActivities as $activity){
            // проверяем, попадает ли заданное время начала в интервал блокирующей Активности
            if( ($activity->startDateTime <= $model->$attribute) && ($activity->endDateTime > $model->$attribute) ){
                $model->addError($attribute,'Это время уже занято');
            }
        }

    }
}