<?php


namespace app\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class DateTimeBehavior extends Behavior
{
    public $dateTime;
    public $format = 'd.m.Y hh:ii';

    public function events()
    {
        return [ActiveRecord::EVENT_BEFORE_VALIDATE => 'convertDateToDB'];
    }

    public function convertDateToDB() {
        $dt = \DateTime::createFromFormat($this->format, $this->owner->{$this->dateTime});
        if($dt){
//            print_r($dateTime);
//            exit();
            $this->owner->{$this->dateTime} =  $dt->format('Y-m-d H:i');
        }
    }
}