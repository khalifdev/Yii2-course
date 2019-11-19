<?php


namespace app\models;


use app\base\BaseModel;

class Activity extends BaseModel
{
    public $title;

    public $description;

//    public $date;

    public $startDateTime;

    public $endDateTime;

    public $isBlocked;

//    public $isRepeated;
//    public $repeatType;

    const DAY = 0;
    const WEEK = 1;
    const MONTH = 2;
    const REPEAT_TYPE = [self::DAY => 'Каждый день', self::WEEK => 'Каждую неделю',
        self::MONTH => 'Каждый месяц'];

    public $useNotification;

    public $email;
    public $repeatEmail;

    public $files;

    public $ind;


    public function beforeValidate()
    {
        if (!empty($this->startDateTime)) {
            $date = \DateTime::createFromFormat('d-m-Y H:i', $this->startDateTime);
            if ($date) {
                $this->startDateTime = $date->format('Y-m-d H:i');
            }
        }
        if (!empty($this->endDateTime)) {
            $date = \DateTime::createFromFormat('d-m-Y H:i', $this->endDateTime);
            if ($date) {
                $this->endDateTime = $date->format('Y-m-d H:i');
            }
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            ['title', 'trim'],
            [['title', 'description', 'startDateTime'], 'required'],
            [['title', 'startDateTime', 'endDateTime'], 'string'],
            [['startDateTime', 'endDateTime'], 'date', 'format' => 'php:Y-m-d H:i'],
            ['description','string','max' => 300, 'min'=>1],
            [['isBlocked', 'useNotification'], 'boolean'],
//            ['repeatType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
            ['email', 'email'],
            [['email', 'repeatEmail'], 'required', 'when' => function ($model) {
                return $model->useNotification;
            }],
            ['repeatEmail', 'compare', 'compareAttribute' => 'email'],
            [['files'], 'file', 'extensions' => ['jpg', 'png'], 'maxFiles' => 4]
        ];
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
            'email'=>'Ваш E-mail',
            'repeatEmail'=>'Подтвердите E-mail',
            'useNotification'=>'Оповещать',
            'files'=>'Файлы'
        ];
    }


}