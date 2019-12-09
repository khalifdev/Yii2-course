<?php


namespace app\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class DateTimeBehavior extends Behavior
{
    public $dateTime;

    public function events()
    {
        return [ActiveRecord::EVENT_BEFORE_VALIDATE => 'dateTimeFormat'];
    }

    public function dateTimeFormat() {
        $this->dateTime = \DateTime::createFromFormat('d-m-Y H:i', $this->dateTime);
        if($this->dateTime){
            return $this->owner->{$this->dateTime->format('Y-m-d H:i')};
        }
    }
}