<?php
declare(strict_types=1);

namespace app\components;


use app\models\Activity;
use yii\base\Component;

class ActivityComponent extends Component
{
    public $modelClass;

//    public function init()
//    {
//        parent::init();
//
//        //todo f
//    }

    public function getModel()
    {
        return new $this->modelClass;
    }

    public function addActivity(Activity $activity): bool
    {
//        $activity->title = null;
        if ($activity->validate()) {
            return true;
        }



        return false;
    }
}