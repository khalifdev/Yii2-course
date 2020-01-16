<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;
use yii\rbac\ManagerInterface;

class RbacComponent extends BaseComponent
{
    private function getManager(): ManagerInterface
    {
        return \Yii::$app->authManager;
    }

    public function assignNewUser()
    {
        $userId = \Yii::$app->user->getIdentity()->id;
        $manager = $this->getManager();
        $role = $manager->getRole('user');
        $manager->assign($role, $userId);
        return true;
    }

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