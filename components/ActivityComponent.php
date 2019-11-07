<?php

namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;

class ActivityComponent extends BaseComponent
{
    public $modelClass;

    public function getModel()
    {
        return new $this->modelClass;
    }

    public function addActivity(Activity $activity)
    {
        if ($activity->validate()) {
            return true;
        }

        return false;
    }
}