<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;

class RbacComponent extends BaseComponent
{
    public function canCreateActivity(): bool
    {
        return \Yii::$app->user->can('createActivity');
    }

    public function canAdminActivity(): bool
    {
        return \Yii::$app->user->can('adminActivity');
    }

    public function canViewActivity(Activity $activity)
    {
        if (\Yii::$app->user->can('adminActivity')) {
            return true;
        }

        if (\Yii::$app->user->can('viewOwnerActivity',['activity'=>$activity])) {
            return true;
        }
        return false;

    }
}