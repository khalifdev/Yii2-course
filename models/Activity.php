<?php


namespace app\models;


use app\base\BaseModel;

class Activity extends BaseModel
{
    public $title;

    public $description;

    public $date;

    public $startTime;

    public $endTime;

    public $isBlocked;

    public $isRepeat;
    public $repeatType;

    const DAY = 0;
    const WEEK = 1;
    const MONTH = 2;
    const REPEAT_TYPE = [self::DAY => 'Каждый день', self::WEEK => 'Каждую неделю',
        self::MONTH => 'Каждый месяц'];

    public $useNotification;

    public $email;
    public $repeatEmail;

    public $files;


    public function beforeValidate()
    {
        if (!empty($this->date)) {
            $date = \DateTime::createFromFormat('d.m.Y', $this->date);
            if ($date) {
                $this->date = $date->format('Y-m-d');
            }
        }
        return parent::beforeValidate();
    }

    public function rules()
    {
        return [
            ['title', 'trim'],
            [['title', 'description', 'date'], 'required'],
            [['title', 'date', 'startTime', 'endTime'], 'string'],
            ['date', 'date', 'format' => 'php:Y-m-d'],
            ['description','string','max' => 300, 'min'=>1],
            [['isBlocked','isRepeat', 'useNotification'], 'boolean'],
            ['repeatType', 'in', 'range' => array_keys(self::REPEAT_TYPE)],
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
            'date'=>'Дата',
            'startTime'=>'Время начала',
            'endTime'=>'Время окончания',
            'isBlocked'=>'Блокирующее событие',
            'isRepeated'=>'Повторяющееся',
            'repeatType'=>'Частота повторения',
            'email'=>'Ваш E-mail',
            'repeatEmail'=>'Подтвердите E-mail',
            'useNotification'=>'Оповещать',
            'file'=>'Файлы'
        ];
    }


}