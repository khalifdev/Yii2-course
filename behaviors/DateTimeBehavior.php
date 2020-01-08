<?php


namespace app\behaviors;


use yii\base\Behavior;
use yii\db\ActiveRecord;

class DateTimeBehavior extends Behavior
{
    public $dateTimeFields = [];

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'convertDateToDB',
            ActiveRecord::EVENT_AFTER_FIND => 'convertDateToApp',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'setUpdatedAt'
        ];
    }

    public function convertDateToDB() {
        foreach ($this->dateTimeFields as $dateTime){
            if ($this->owner->{$dateTime}) {
                $dt = \DateTime::createFromFormat('d.m.Y H:i', $this->owner->{$dateTime});
                if($dt){
                    $this->owner->{$dateTime} =  $dt->format('Y-m-d H:i');
                }
            }
        }

    }

    public function convertDateToApp() {

        foreach ($this->dateTimeFields as $dateTime){
            if ($this->owner->{$dateTime}) {
                //echo $this->owner->{$dateTime} . ' ';
                $dt = \DateTime::createFromFormat('Y-m-d H:i:s', $this->owner->{$dateTime});
//                print_r($dt);
                if($dt){

                    $this->owner->{$dateTime} =  $dt->format('d.m.Y H:i');
                }
            }
        }
//        exit();
    }

    public function setUpdatedAt()
    {
        date_default_timezone_set('Europe/Moscow');
        $this->owner->updatedAt = date('Y-m-d H:i');
    }
}