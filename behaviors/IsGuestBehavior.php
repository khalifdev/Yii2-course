<?php


namespace app\behaviors;


use yii\base\Behavior;
use yii\base\Controller;

class IsGuestBehavior extends Behavior
{
    public function events()
    {
        return [Controller::EVENT_BEFORE_ACTION => 'guestRedirect'];
    }

    public function guestRedirect()
    {

        if(\Yii::$app->user->isGuest)
        {
            return $this->owner->redirect('/auth/sign-in');
        }
    }
}