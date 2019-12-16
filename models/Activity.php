<?php


namespace app\models;


use app\base\BaseModel;
use app\behaviors\DateTimeBehavior;
use yii\db\ActiveRecord;

class Activity extends ActivityBase
{

//    public $isRepeated;
//    public $repeatType;

    const DAY = 0;
    const WEEK = 1;
    const MONTH = 2;
    const REPEAT_TYPE = [self::DAY => 'Каждый день', self::WEEK => 'Каждую неделю',
        self::MONTH => 'Каждый месяц'];

//    public $useNotification;

//    public $repeatEmail;


    public function behaviors()
    {
        return [
            ['class'=>DateTimeBehavior::class, 'dateTime' => 'startDateTime'],
            ['class'=>DateTimeBehavior::class, 'dateTime' => 'endDateTime'],
        ];
    }

//    public function beforeValidate()
//    {
//        if (!empty($this->startDateTime)) {
//            $date = \DateTime::createFromFormat('d-m-Y H:i', $this->startDateTime);
//            if ($date) {
//                $this->startDateTime = $date->format('Y-m-d H:i');
//            }
//        }
//        if (!empty($this->endDateTime)) {
//            $date = \DateTime::createFromFormat('d-m-Y H:i', $this->endDateTime);
//            if ($date) {
//                $this->endDateTime = $date->format('Y-m-d H:i');
//            }
//        }
//        return parent::beforeValidate();
//    }

    public function rules()
    {
        return array_merge([
            ['title', 'trim'],
//            [['startDateTime', 'endDateTime'], 'string'],
            [['startDateTime', 'endDateTime'], 'date', 'format' => 'php:Y-m-d H:i'],
            ['endDateTime', 'compare', 'compareAttribute' => 'startDateTime', 'operator'=>'>='],
            ['description','string','max' => 300, 'min'=>1],
            ['isBlocked', 'boolean'],
//            ['repeatType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
            ['email', 'email'],
//            [['email', 'repeatEmail'], 'required', 'when' => function ($model) {
//                return $model->useNotification;
//            }],
//            ['repeatEmail', 'compare', 'compareAttribute' => 'email'],
            [['files'], 'file', 'extensions' => ['jpg', 'png'], 'maxFiles' => 4]
        ],parent::rules());
    }

    public function attributeLabels()
    {
        return [
            'title'=>'Заголовок активности',
            'description'=>'Описание',
            'startDateTime'=>'Время начала',
            'endDateTime'=>'Время окончания',
            'isBlocked'=>'Блокирующая активность',
//            'isRepeated'=>'Повторяющееся',
//            'repeatType'=>'Частота повторения',
//            'email'=>'Ваш E-mail',
//            'repeatEmail'=>'Подтвердите E-mail',
//            'useNotification'=>'Оповещать',
            'files'=>'Файлы'
        ];
    }


}