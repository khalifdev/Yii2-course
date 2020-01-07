<?php


namespace app\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class DateTimeBehavior extends Behavior
{
    public $dateTime;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'convertDateToDB',
            ActiveRecord::EVENT_AFTER_FIND => 'convertDateToApp',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'setUpdatedAt'
        ];
    }

    public function convertDateToDB() {
        $dt = \DateTime::createFromFormat('d.m.Y H:i', $this->owner->{$this->dateTime});
        if($dt){
            $this->owner->{$this->dateTime} =  $dt->format('Y-m-d H:i');
        }
    }

    public function convertDateToApp() {
        $dt = \DateTime::createFromFormat('Y-m-d H:i:s', $this->owner->{$this->dateTime});
        if($dt){
            $this->owner->{$this->dateTime} =  $dt->format('d.m.Y H:i');
        }
    }

    public function setUpdatedAt()
    {
        date_default_timezone_set('Europe/Moscow');
        $this->owner->updatedAt = date('Y-m-d H:i');
    }
}